<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Product;
use App\Repositories\Admin\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use \Gate;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository){
        $this->productRepository = $productRepository;
    }

    public function index(){
        $products = $this->productRepository->getAll();
        return view('admin.products.index',[
            'title' => 'Products Management',
            'products' => $products,
        ]);
    }

    public function create(){
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.products.create',[
            'title' => 'Create New Product',
        ]);
    }

    public function store(ProductRequest $request){
        try {
            $data = [
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
            ];
            $this->productRepository->create($data);
            Session::flash('success','Create new product success');
        }catch (\Exception $err){
            Session::flash('error','Create new product fail');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }

    public function edit($id){
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $products = $this->productRepository->find($id);
        return view('admin.products.edit',[
            'title'=>'Edit Product',
            'products'=>$products,
        ]);
    }

    public function update(ProductRequest $request, $id){
        $role = $this->productRepository->find($id);
        try {
            if ($role){
                $this->productRepository->update($id, $request->all());
                Session::flash('success','Update product success');
            }
        }catch (\Exception $err){
            Session::flash('error','Update permission fail');
            \Log::info($err->getMessage());
        }
        return redirect()->back();
    }
    public function delete(Request $request){
        $product = Product::find($request->input('product_id'));
        $id = $request->input('product_id');
        if ($product) {
            $product->delete();
            $this->productRepository->delete($id);
            return redirect(route('admin.products.index'))
                ->with('success', __('Xóa thành công!'));
        }
        return redirect(route('admin.products.index'))
            ->with('error', __('Xóa không thành công!'));
    }
}
