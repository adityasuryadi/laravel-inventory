<?php

namespace App\Services;
use Illuminate\Support\Str;
use App\Helpers\AutoNumber;
use App\Services\DetailSalesService;
use App\Services\ProductService;
use App\Services\SalesPaymentService;
use App\Models\SalesPayment;
use App\Models\Sales;
use DB;
use Auth;

class SalesService {
    public function saveSales($model,$data){
        $detail_sales_service=new DetailSalesService;
        $product_service = new ProductService;
        $total = 0;
        $pcs = 0;
        $amount = 0;
        foreach($data['carts'] as $cart){
           $total+= ($cart['sales_amount'] * $cart['sales_price']);
           $pcs+= $cart['sales_pcs'];
           $amount+= $cart['sales_amount'];
        }

        $model->id   = Str::uuid();
        $model->invoice_no = AutoNumber::generateInvoiceNumber();;
        $model->delivery_orders = AutoNumber::generateDeliveryOrders();
        $model->user_id = Auth::user()->id;
        $model->total = $total;
        $model->pcs = $pcs;
        $model->amount = $amount;
        $model->customer_id = $data['customer']['id'];
        $model->company_id = $data['company']['id'];
        $model->description = $data['description'];
        $model->save();

        $data['sales_id'] = (string) $model->id;
        $detail_sales_service->saveDetailSales(new \App\Models\DetailSales,$data);
        
        $sales_payment = new SalesPayment([
            'id'    => Str::uuid(),
            'user_id' => Auth::user()->id,
            'total'   => $total,
            'remaining_payment'=>$total
        ]);
        $model->sales_payment()->save($sales_payment);

    }

    public function processInvoice($id){
        $model = Sales::findOrFail($id);
        if($model->invoice_no == null){            
            $model->invoice_no = AutoNumber::generateInvoiceNumber();
            $model->save();
        }else{
            abort(404);
        }
    }

    public function getSalesReportPerMonth(){
        $months=[];
        $sales=[];
        for($m=1; $m<=12; ++$m){
            array_push($months,date('F', mktime(0, 0, 0, $m, 1)));
            array_push($sales, Sales::whereMonth('created_at',$m)->sum('total'));
        }

        $data['data']=$sales;
        $data['label']='Penjualan';

        return $data;
    }

    public function getSalesDebetPerMonth(){
        $months=[];
        $debet=[];

        for($m=1; $m<=12; ++$m){
            array_push($months,date('F', mktime(0, 0, 0, $m, 1)));
            array_push($debet, 
            Sales::join('sales_payments','sales.id','=','sales_payments.sales_id')
            ->join('detail_sales_payments','sales_payments.id','=','detail_sales_payments.sales_payment_id')
            ->select("detail_sales_payments.amount","detail_sales_payments.amount")
            ->whereMonth('detail_sales_payments.date',$m)->sum("detail_sales_payments.amount")
            );
        }

        
        $data['data']=$debet;
        $data['label']='Debet';

        return $data;
    }

    public function getSalesCreditPerMonth(){
        $months=[];
        $credit=[];
        
        $kredit = \App\Models\Sales::select(DB::raw("sum(total) as debet,(to_char(created_at, 'MM')) as month"))
        ->groupBy('month')->get();
        $tmp =Sales::with('sales_payment')->get();

        for($m=1; $m<=12; ++$m){
            array_push($months,date('F', mktime(0, 0, 0, $m, 1)));
            array_push($credit, Sales::whereMonth('created_at',$m)->sum('total'));
        }

        $data['data']=$credit;
        $data['label']='Kredit';

        return $data;
    }

}