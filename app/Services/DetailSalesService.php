<?php
namespace App\Services;
use App\Services\ProductServices;
use App\Models\DetailSales;

class DetailSalesService{
    public function saveDetailSales($model,$data){
        $productService = new ProductService;
        foreach ($data['carts'] as $product) {
            $model =  new DetailSales;
            $productService->decrementPcs($product['product']['id'],$product['sales_pcs']);
            $productService->decrementAmount($product['product']['id'],$product['sales_amount'],$product['sales_unit']['id']);
            $model->product_id = $product['product']['id'];
            $model->sales_amount= $product['sales_amount'];
            $model->sales_pcs = $product['sales_pcs'];
            $model->sales_price = $product['sales_price'];
            $model->sales_id = $data['sales_id'];
            $model->sales_unit = $product['sales_unit']['id'];
            $model->packing_lists = $product['packing_lists'];
            $model->save();
        }
    }
}