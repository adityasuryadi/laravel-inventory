<?php
namespace App\Helpers;

class NumberFormat
{
    public static function idrFormat($value){
        return 'Rp '.number_format($value,0,',','.');
    }
}
