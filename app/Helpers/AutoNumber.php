<?php 
namespace App\Helpers;
use DB;
use App\Models\Sales;

class AutoNumber {
    public static function generateInvoiceNumber(){
        $prefix = 'SBJ';
        $last_data=Sales::latest()->value('invoice_no');

        if($last_data === null){
            $max_number = 0;
        }else{
            $tmp = explode('.',$last_data);
            if($tmp[4] === date('y')){
                $max_number = intval($tmp[1]);
            }else{
                $max_number = 0;
            }
        }
        $invoice_number = 'INV.'.($max_number+1).'.'.date('m').'.'.$prefix.'.'.date('y');
        return $invoice_number;
    }

    public static function generateDeliveryOrders(){
        $prefix = 'SBJ';
        $last_data=Sales::latest()->value('delivery_orders');

        if($last_data === null){
            $max_number = 0;
        }else{
            $tmp = explode('.',$last_data);
            if($tmp[4] === date('y')){
                $max_number = intval($tmp[1]);
            }else{
                $max_number = 0;
            }
        }
        $invoice_number = 'DO.'.($max_number+1).'.'.date('m').'.'.$prefix.'.'.date('y');
        return $invoice_number;
    }
}

?>