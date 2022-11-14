<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AutoNumber;
use App\Services\ProductService;
use App\Services\SalesService;
use App\Models\Sales;
use App\DataTables\SalesDataTable;
use DB;
use PDF;
class SalesController extends Controller
{
    public function index(SalesDataTable $dataTable){
        $this->authorize('sales.create');
        $title = 'List Penjualan';
        return $dataTable->render('backend.sales.index',compact('title'));
    }

    public function create()
    {
        $this->authorize('sales.create');
        return view('backend.sales.create')
        ->withTitle('Sales');
    }

    public function store(Request $request) {
        $productService = new ProductService;
        $salesService = new SalesService;
        $model =  new Sales;
        $data = $request->all();
        $salesService->saveSales($model,$data);
    }

    public function show($id){
        $this->authorize('sales.view');
        $sales=Sales::with('customer','company','detailSales.product.article','detailSales.unit')->findOrFail($id);
        return view('backend.sales.view')
        ->with('title','Invoice '.$sales->invoice_no)
        ->with('sales',$sales);
    }

    public function printInvoice($id){
        $sales=Sales::with('customer','detailSales.product.article','detailSales.unit')->findOrFail($id);
        $pdf = PDF::loadView('backend.sales.pdf.faktur', compact('sales'));
        return $pdf->stream('Invoice_'.$sales->invoice_no.'.pdf');
    }

    public function printSuratJalan($id){
        $sales=Sales::with('customer','company','detailSales.product.article','detailSales.unit')->findOrFail($id);
        $pdf = PDF::loadView('backend.sales.pdf.surat_jalan', compact('sales'));
        return $pdf->stream('surat_jalan_'.$sales->delivery_orders.'.pdf',array("Attachment" => false));
    }   

    public function salesReportPerMonth(){
        // $months=[];
        // $sales=[];
        // $tmp=Sales::select(DB::raw("sum(total) as total, (to_char(created_at, 'MM')) as month"))
        // ->groupBy('month')
        // ->get();
        // for($m=1; $m<=12; ++$m){
        //     array_push($months,date('F', mktime(0, 0, 0, $m, 1)));
        //     array_push($sales, Sales::whereMonth('created_at',$m)->sum('total'));
        // }
        $sales=Sales::with('company','customer','detailSales','detailSales.product','detailSales.unit')->get();
        return view('backend.report.sales_report')
        ->withTitle('Laporan Penjualan')
        // ->withMonths($months)
        ->withSales($sales);
    }

    public function processInvoice($id){
        $this->authorize('sales.create');
        $salesService = new SalesService;
        $salesService->processInvoice($id);

        return redirect()->route('sales.index');
    }
    
}
