<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ProductService;

use App\Models\Product;

use App\DataTables\ProductDataTable;

class ProductController extends Controller
{   
    public function getProducts()
    {
        $products = Product::with('article')->get();
        return $products;
    }

    public function index(ProductDataTable $dataTable)
    {
        $this->authorize('product.create');
        $title='List Barang';
        return $dataTable->render('backend.product.index',compact('title'));
    }

    public function create(){
        $this->authorize('product.create');
        return view('backend.product.create')
        ->withTitle('Barang');
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'price'=>'required|numeric',
            'principal_price'=>'required|numeric',
            'amount'=>'required|numeric',
            'pcs'=>'required|numeric',
            'color'=>'required',
            'article_id'=>'required'
        ],[
            'price.required'=>'Harga harus di isi',
            'price.numeric'=>'Harga harus angka',
            'principal_price.required'=>'Harga Pokok harus di isi',
            'principal_price.numeric'=>'Harga Pokok harus angka',
            'pcs.required'=>'PCS harus di isi',
            'pcs.numeric'=>'PCS harus angka',
            'amount.required'=>'Stok harus di isi',
            'amount.numeric'=>'Stok harus angka',
            'color.required'=>'Warna harus di isi',
            'article_id.required'=>'Artikel harus di isi'
        ]);
        $service = new ProductService;
        $model = new Product;
        $service->saveProduct($model,$request);

        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $this->authorize('product.edit');
        $product=Product::findOrFail($id);
        return view('backend.product.edit')
        ->with('product',$product)
        ->with('title','Edit Barang '.$product->color);
    }

    public function update(Request $request,$id)
    {
        $service = new ProductService;
        $model = Product::findOrFail($id);
        $service->saveProduct($model,$request);

        return redirect()->route('product.index');
    }

    public function destroy($id){
        $this->authorize('product.delete');
        $product=Product::findOrFail($id);
        $product->delete();

        return redirect()->route('product.index');
    }

    public function getProductByArticle($article_id){
        $product = Product::with('article')->where('article_id',$article_id)->get();
        return $product;
    }
}
