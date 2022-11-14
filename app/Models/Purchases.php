<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    protected $primaryKey = 'id';
    protected $keyType='string';
    public $incrementing = false;

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function detailPurchases(){
        return $this->hasMany(DetailPurchases::class,'purchase_id','id');
    }

    public function purchases_payment(){
        return $this->hasOne(PurchasesPayment::class);
    }
}
