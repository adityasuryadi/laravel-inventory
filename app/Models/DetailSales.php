<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSales extends Model
{
    protected $primaryKey='id';

    protected $casts = ['packing_lists'=>'array'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function unit(){
        return $this->belongsTo(SysValue::class,'sales_unit','id');
    }

    public function sales(){
        return $this->belongsTo(Sales::class);
    }
}
