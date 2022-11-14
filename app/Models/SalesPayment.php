<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPayment extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id','sales_id','total','remaining_payment','user_id'];

    public function sales(){
        return $this->hasOne(Sales::class,'id','sales_id');
    }

    public function detail_sales_payment(){
        return $this->hasMany(DetailSalesPayment::class);
    }

    public function sumPayment(){
        return $this->detail_sales_payment();
    }
}
