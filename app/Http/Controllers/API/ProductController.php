<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Product::select('id', 'name', 'detail', 'brand', 'price', 'category_id', 'image');
        $name = $request->get('name');
        $price = $request->get('price');

        $price_max = $request->get('price_max');
        $price_desc = $request->get('price_desc');
        $name_desc = $request->get('name_desc');
        $catename = $request->get('catename');
        if ($name) {
            $result = $result->where('name', 'like', '%' . $name . '%');
        }
        if ($price) {
            $result = $result->where('price', '>=', $price);
        }
        if ($price_max) {
            $result = $result->where('price', '<=', $price_max);
        }
        if ($price_desc == 1) {
            $result = $result->orderByRaw('price * 1 desc');
        }
        if ($price_desc == 2) {
            $result = $result->orderByRaw('price * 1 asc');
        }
        if ($name_desc == 1) {
            $result = $result->orderBy('name', 'desc');
        }
        if ($name_desc == 2) {
            $result = $result->orderBy('name', 'asc');
        }
        if ($catename){
            $cate_id = Category::where('name','like','%' .$catename.'%')->pluck('id');
            $result = $result->where('category_id','=',$cate_id);
        }
        
        if (count($result->get()) > 0) {
            return $this->sendResponse($result->get(), 'Products retrieved successfully.');
        } else {
            return $this->sendError('Cannot find Products');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:products',
            'detail' => 'required',
            'price' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validator Error.', $validator->errors());
        }
        $product = Product::create($input);
        return $this->sendResponse($product, 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        return $this->sendResponse($product, 'Product retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validator Error.', $validator->errors());
        }
        $product = Product::find($id);
        $product->update($request->all());
        return $this->sendResponse($product, 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return $this->sendResponse($id, 'Product deleted successfully.');
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {

        $result = Product::where('name', 'like', '%' . $name . '%')->get();
        if (is_null($result)) {
            return $this->sendError('Product not found.');
        }
        return $this->sendResponse($result, 'Product searched successfully.');
    }
}
