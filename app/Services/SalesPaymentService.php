<?php

namespace App\Services;
use Illuminate\Support\Str;

class SalesPaymentService {
    public function saveSalesPayment($model,$data){
        $model->id   = Str::uuid();
        $model->sales_id = $data->sales_id;
        $model->total = $data->total;
        $model->remaining_payment = $data->remaining_payment;
        $model->user_id = $data->user_id;
        $model->save();
    }
}