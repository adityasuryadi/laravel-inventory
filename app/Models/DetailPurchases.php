<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPurchases extends Model
{
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function unit(){
        return $this->belongsTo(SysValue::class,'purchase_unit','id');
    }
}
