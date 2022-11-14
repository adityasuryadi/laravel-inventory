<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'id';
    protected $keyType='string';
    public $incrementing = false;

    public function purchases(){
        return $this->hasMany(Purchases::class);
    }
}
