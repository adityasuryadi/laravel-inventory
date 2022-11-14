<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    
    protected $tables='products';
    protected $primaryKey = 'id';
    protected $keyType='string';
    public $incrementing = false;
    
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function unit(){
        return $this->belongsTo(SysValue::class);
    }
}
