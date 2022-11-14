<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WindShield extends Model
{
    public function rack(){
        return $this->belongsToMany(Rack::class)->withPivot('qty');
    }

    public function windshieldBrand(){
        return $this->belongsTo(WindShieldBrand::class,'wind_shield_brand_id','id');
    }

    public function windshieldPart(){
        return $this->belongsTo(WindShieldPart::class,'wind_shield_part_id','id');
    }

    public function carType(){
        return $this->belongsTo(CarType::class,'car_type_id','id');
    }
}
