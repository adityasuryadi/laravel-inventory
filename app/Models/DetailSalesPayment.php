<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSalesPayment extends Model
{
    protected $fillable = ['user_id','amount','sales_id','date','note'];

    
}
