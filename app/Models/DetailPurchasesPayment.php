<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPurchasesPayment extends Model
{
    protected $fillable = ['user_id','amount','sales_id','date','note'];
       
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function unit(){
        return $this->belongsTo(SysValue::class,'purchase_unit','id');
    }
}
