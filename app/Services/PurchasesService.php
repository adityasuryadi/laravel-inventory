<?php

namespace App\Services;
use Illuminate\Support\Str;
use App\Helpers\AutoNumber;
use App\Services\DetailPurchasesService;
use App\Models\DetailPurchases;
use App\Models\Purchases;
use App\Models\PurchasesPayment;
use Auth;
use DB;

class PurchasesService {
    public function savePurchases($model,$data){
        $detail_purchase_service=new DetailPurchasesService;
        $total = 0;
        $pcs = 0;
        $amount = 0;
        foreach($data['carts'] as $cart){
           $pcs+= $cart['purchase_pcs'];
           $amount+= $cart['purchase_amount'];
           $total += ($cart['principal_price'] * $cart['purchase_amount']);
        }

        $model->id   = Str::uuid();
        $model->user_id = Auth::user()->id;
        $model->pcs = $pcs;
        $model->amount = $amount;
        $model->total = $total;
        $model->supplier_id = $data['supplier']['id'];
        $model->save();

        $data['purchase_id'] = (string) $model->id;
        $detail_purchase_service->saveDetailPurchases(new \App\Models\DetailPurchases,$data);

        $purchases_payment = new PurchasesPayment([
            'id'    => Str::uuid(),
            'user_id' => Auth::user()->id,
            'total'   => $total,
            'remaining_payment'=>$total
        ]);
        $model->purchases_payment()->save($purchases_payment);

    }

    public function getPurchasesReportPerMonth(){
        $months=[];
        $purchases=[];
        $tmp=Purchases::select(DB::raw("sum(total) as total, (to_char(created_at, 'MM')) as month"))
        ->whereYear('created_at',date('Y'))
        ->groupBy('month')
        ->get();
        for($m=1; $m<=12; ++$m){
            array_push($months,date('F', mktime(0, 0, 0, $m, 1)));
            array_push($purchases, Purchases::whereMonth('created_at',$m)->sum('total'));
        }

        $data['data']=$purchases;
        $data['label']='Pembelian';

        return $data;
    }
}