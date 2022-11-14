<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id';
    protected $keyType='string';
    public $incrementing = false;

    public function sales(){
        return $this->hasMany(Sales::class);
    }
}
