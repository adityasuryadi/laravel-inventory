<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasesPayment extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id','purchases_id','total','remaining_payment','user_id'];

    public function purchases(){
        return $this->hasOne(Purchases::class,'id','purchases_id');
    }

    public function detail_purchases_payment(){
        return $this->hasMany(DetailPurchasesPayment::class);
    }

    public function sumPayment(){
        return $this->detail_purchases_payment();
    }
}
