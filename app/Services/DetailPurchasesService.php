<?php 
namespace App\Services;
use App\Services\ProductService;
use App\Models\DetailPurchases;

class DetailPurchasesService{
    public function saveDetailPurchases($model,$data){
        $productService = new ProductService;
        foreach ($data['carts'] as $product) {
            $model =  new DetailPurchases;
            $productService->incrementPcs($product['product']['id'],$product['purchase_pcs']);
            $productService->incrementAmount($product['product']['id'],$product['purchase_amount'],$product['purchase_unit']['id']);
            $productService->ChangePrincipalPrice($product['product']['id'],$product['principal_price']);
            $model->product_id = $product['product']['id'];
            $model->purchase_amount= $product['purchase_amount'];
            $model->purchase_pcs = $product['purchase_pcs'];
            $model->purchase_id = $data['purchase_id'];
            $model->purchase_unit = $product['purchase_unit']['id'];
            $model->purchase_price = $product['principal_price'];
            $model->save();
        }
    }
}