<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\carType;

class Car extends Model
{
    protected $table = 'cars';
    protected $primaryKey = 'id';
    protected $keyType='string';
    public $incrementing = false;

    public function carType(){
        return $this->hasMany(CarType::class);
    }

    public function brandCar(){
        return $this->belongsTo(BrandCar::class);
    }
}
