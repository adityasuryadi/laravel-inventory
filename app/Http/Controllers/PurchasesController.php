<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchases;
use App\Services\PurchasesService;
use App\Services\ProductService;
use App\DataTables\PurchasesDataTable;

class PurchasesController extends Controller
{
    public function index(PurchasesDataTable $dataTable){
        $this->authorize('purchase.create');
        $title='List Penjualan';
        return $dataTable->render('backend.purchases.index',compact('title'));
    }

    public function create(){
        return view('backend.purchases.create');
    }

    public function store(Request $request){
        $productService = new ProductService;
        $purchasesService = new PurchasesService;
        $model =  new Purchases;
        $data = $request->all();
        $purchasesService->savePurchases($model,$data);
    }

    public function show($id){
        // $this->authorize('purchase.view');
        $purchases=Purchases::with('supplier','purchases_payment','purchases_payment.detail_purchases_payment','detailPurchases.product.article','detailPurchases.unit')->findOrFail($id);
        return view('backend.purchases.view')
        ->with('title','Pembelian')
        ->with('purchases',$purchases);
    }
}
