<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $categories = Category::all();
        return $this->sendResponse($categories,'Categories retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request){
        $input = $request->all();
        $validator = Validator::make($input,[
            'name'=>'required',
            'description'=>'required',
            'photo'=>'required',
            'tax' => 'required',
            'unit' => 'required'
        ]);
        if ($validator->fails()){
            return $this->sendError('Validator Error.',$validator->errors());
        }
        $category = Category::create($input);
        return $this->sendResponse($category,'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id){
        $category = Category::find($id);
        if (is_null($category)){
            return $this->sendError('Category not found.');
        }
        return $this->sendResponse($category,'category retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$id){
        $input = $request->all();
        $validator = Validator::make($input,[
            'name'=>'required',
            'description'=>'required',
            'photo'=>'required',
            'tax' => 'required',
            'unit' => 'required'
        ]);
        if ($validator->fails()){
            return $this->sendError('Validator Error.',$validator->errors());
        }
        $category = Category::find($id);
        $category->update($request->all());
        return $this->sendResponse($category, 'Category updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        Category::destroy($id);
        $products = Product::select('id')->where('category_id','=',$id)->delete();
        return $this->sendResponse($id,'Category deleted successfully.');
    }
    /**
     * Search for a name
     *
     * @param string $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function search($name){
        $result = Category::where('name', 'like', '%'.$name.'%')->get();
        if (is_null($result)){
            return $this->sendError('Category not found.');
        }
        return $this->sendResponse($result,'Category searched successfully.');
    }
}
