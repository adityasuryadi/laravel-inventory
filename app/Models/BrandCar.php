<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BrandCar extends Model
{
    protected $table = 'brand_cars';
    protected $primaryKey = 'id';
    
    public function car(){
        return $this->hasMany(Car::class);
    }
}
