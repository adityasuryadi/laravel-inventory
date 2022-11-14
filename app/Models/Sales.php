<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $primaryKey = 'id';
    // protected $keyType='string';
    public $incrementing = false;

    public function detailSales(){
        return $this->hasMany(DetailSales::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function sales_payment(){
        return $this->hasOne(SalesPayment::class);
    }
}
