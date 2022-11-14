<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    protected $fillable = ['name'];

    public function car(){
        return $this->belongsTo(Car::class,'car_id','id');
    }
}
