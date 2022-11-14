<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\DataTables\CustomerDataTable;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(CustomerDataTable  $dataTable){
        $this->authorize('customer.create');
        $title = "List Kustomer";
        return $dataTable->render('backend.customer.index',compact('title'));
    }

    public function create(){
        $this->authorize('customer.create');
        return view('backend.customer.create');
    }

    public function store(Request $request){
       $this->validate($request,[
           'name'=>'required',
           'address'=>'required'
       ],[
           'name.required'=>'Nama Harus di isi',
           'address.required'=>'Alamat harus di isi'
       ]);
       $customer = new Customer;
       $customer->id = Str::uuid();
       $customer->name = $request->input('name');
       $customer->address = $request->input('address');
       $customer->save();

        return redirect()->route('customer.index');
    }

    public function edit($id){
        $this->authorize('customer.create');
        $customer=customer::findOrFail($id);
        return view('backend.customer.edit')
        ->withTitle('Edit Artikel '.$customer->name)
        ->withcustomer($customer);
    }

    public function update($id,Request $request){
        $customer=Customer::findOrFail($id);
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required'
        ],[
            'name.required'=>'Nama Harus di isi',
            'address.required'=>'Alamat harus di isi'
        ]);
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->save();

        return redirect()->route('customer.index');
    }

    public function destroy($id){
        $this->authorize('customer.delete');
        $customer=Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index');
    }

    public function show($id){
        $customer=Customer::with(['sales.detailSales.product','sales.detailSales.unit','sales.sales_payment.detail_sales_payment'=>function($q){
            // $q->where('created_at','2019-01-01');
        }])->findOrFail($id);
        return view('backend.customer.view')
        ->withTitle('Customer')
        ->withCustomer($customer);
    }

    public function getCustomers(){
        $customers=Customer::all();
        return $customers;
    }

    public function reportCustomerBalance($id,Request $request){
        $customer=Customer::with(['sales'=>function($q) use ($request){
            $q->whereBetween('created_at',[$request->input('start_date'),$request->input('end_date')]);
        },'sales.detailSales.product','sales.detailSales.unit','sales.sales_payment.detail_sales_payment'=>function($q) use ($request){
            $q->whereBetween('date',[$request->input('start_date'),$request->input('end_date')]);
        }])->findOrFail($id);

        return view("backend.customer.report_balance")->withCustomer($customer);
    }
}
