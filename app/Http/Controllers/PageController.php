<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SalesService;
use App\Services\PurchasesService;
use App\Models\Customer;
use App\Models\Supplier;
use DB;

class PageController extends Controller
{
    public function dashboard(){
        $purchases_service = new PurchasesService();
        $sales_service = new SalesService;

        $months=[];
        for($m=1; $m<=12; ++$m){
            array_push($months,date('F', mktime(0, 0, 0, $m, 1)));
        }


        $data_chart[0] = $sales_service->getSalesReportPerMonth();
        $data_chart[1] = $purchases_service->getPurchasesReportPerMonth();
        $data_balance[0] = $sales_service->getSalesDebetPerMonth();
        $data_balance[1] = $sales_service->getSalesCreditPerMonth();
        return view('welcome')
        ->with('data_chart',$data_chart)
        ->with('months',$months)
        ->with('data_balance',$data_balance);
    }

    public function report(Request $request){
        

        return view('backend.report_balance')
        ->withTitle('Report Hutang dan Piutang');
    }

    public function getReportDataGlobal(Request $request){
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $customers = Customer::join('sales','customers.id','=','sales.customer_id')
            ->join('sales_payments','sales.id','=','sales_payments.sales_id')
            ->leftJoin(DB::raw("(select detail_sales_payments.sales_payment_id as sp_id,sum(detail_sales_payments.amount) as debet from detail_sales_payments where date between '".$request->input('start_date')."' and '".$request->input('end_date')."' group by sales_payment_id) as detail_payment"),'detail_payment.sp_id', '=' ,'sales_payments.id')
            ->select(DB::raw("customers.name,customers.id,sum(sales_payments.total) as kredit,sum(debet) as debet"))
            ->whereBetween('sales.created_at',[$start_date,$end_date])
            ->groupBy("customers.id")
            ->get();

            $suppliers = Supplier::join('purchases','suppliers.id','=','purchases.supplier_id')
            ->join('purchases_payments','purchases.id','=','purchases_payments.purchases_id')
            ->leftJoin(DB::raw("(select detail_purchases_payments.purchases_payment_id,sum(detail_purchases_payments.amount) as debet from detail_purchases_payments where date between '".$request->input('start_date')."' and '".$request->input('end_date')."' group by purchases_payment_id) as detail_payment"),'detail_payment.purchases_payment_id', '=' ,'purchases_payments.id')
            ->select(DB::raw("suppliers.id,suppliers.name,sum(purchases_payments.total) as kredit,sum(debet) as debet"))
            ->whereBetween('purchases.created_at',[$start_date,$end_date])
            ->groupBy("suppliers.id")
            ->get();
            
        return view('backend.report_global_template')
        ->withCustomers($customers)
        ->withSuppliers($suppliers)
        ->with('start_date',$start_date)
        ->with('end_date',$end_date);   
    }
}
