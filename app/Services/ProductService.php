<?php

namespace App\Services;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductService {
    public function saveProduct($model,$data){
        if(!isset($model->id)){
        $model->id   = Str::uuid();
        }
        $model->article_id = $data->article_id;
        $model->color = $data->color;
        $model->pcs  = $data->pcs;
        $model->amount = $data->amount;
        $model->price = $data->price;
        $model->unit_id = $data->unit_id;
        $model->principal_price = $data->principal_price;
        $model->save();
    }

    public function incrementPcs($id,$value){
        $product=Product::findOrFail($id);
        $product->increment('pcs',$value);
    }

    public function decrementPcs($id,$value){
        $product=Product::findOrFail($id);
        $product->decrement('pcs',$value);
    }

    public function incrementAmount($id,$value,$unit){
        $product=Product::findOrFail($id);
        if($unit === '052f7e1c-6d31-42be-941a-eba4fd5e3b18'){ //jika satuan meter
            $value *= 1.094;
        }else{
            $value = $value;
        }
        $product->increment('amount',$value);
    }

    public function decrementAmount($id,$value,$unit){
        $product=Product::findOrFail($id);
        if($unit === '052f7e1c-6d31-42be-941a-eba4fd5e3b18'){ //jika satuan meter
            $value *= 1.094;
        }else{
            $value = $value;
        }
        $product->decrement('amount',$value);
    }

    public function convertUnit($value,$unit){
        if($unit === '963a633f-2a09-45ba-8b90-3a057f39fb7d'){ //jika satuan yard
            $value *= 0.914;
        }
        return $value;
    }

    public function ChangePrincipalPrice($id,$value){
        $product=Product::findOrFail($id);
        $product->principal_price = $value;
        $product->save();
    }

    public function reminderStock(){
        $product = Product::where('pcs','<=','5')->get();
        return $product;
    }

    
}