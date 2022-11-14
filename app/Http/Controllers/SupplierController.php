<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\SupplierDataTable;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\DataBase\Eloquent\SoftDeletes;
class SupplierController extends Controller
{
    use SoftDeletes;
    public function index(SupplierDataTable $dataTable){
        $this->authorize('supplier.create');
        $title = "List Supplier";
        return $dataTable->render('backend.supplier.index',compact('title'));
    }

    public function create(){
        $this->authorize('supplier.create');
        return view('backend.supplier.create')->withTitle("Tambah Supplier");
    }

    public function store(Request $request){
    $this->validate($request,[
        'name'=>'required',
        'address'=>'required',
        'phone'=>'required|numeric'
    ],[
        'name.required'=>'Nama Harus di isi',
        'address.required'=>'Alamat harus di isi',
        'phone.required'=>'No Telepon harus di isi',
        'phone.numeric'=>'No Teepon harus berupa angka'
    ]);
    $supplier = new Supplier;
    $supplier->id = Str::uuid();
    $supplier->name = $request->input('name');
    $supplier->address = $request->input('address');
    $supplier->phone = $request->input('phone');
    $supplier->save();

        return redirect()->route('supplier.index');
    }

    public function edit($id){
        $this->authorize('supplier.edit');
        $supplier=supplier::findOrFail($id);
        return view('backend.supplier.edit')
        ->withTitle('Edit Artikel '.$supplier->name)
        ->withsupplier($supplier);
    }

    public function update($id,Request $request){
        $supplier=Supplier::findOrFail($id);
        $this->validate($request,[
            'name'=>'required',
            'address'=>'required'
        ],[
            'name.required'=>'Nama Harus di isi',
            'address.required'=>'Alamat harus di isi'
        ]);
        $supplier->name = $request->input('name');
        $supplier->address = $request->input('address');
        $supplier->phone = $request->input('phone');
        $supplier->save();

        return redirect()->route('supplier.index');
    }

    public function destroy($id){
        $this->authorize('supplier.delete');
        $supplier=Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplier.index');
    }

    public function getSuppliers(){
        $suppliers=Supplier::all();
        return $suppliers;
    }

    public function show($id){
        $supplier=Supplier::with(['purchases.detailPurchases.product','purchases.detailPurchases.unit','purchases.purchases_payment.detail_purchases_payment'=>function($q){
            // $q->where('created_at','2019-01-01');
        }])->findOrFail($id);
        return view('backend.supplier.view')
        ->withTitle('Supplier')
        ->withSupplier($supplier);
    }

    public function reportSupplierBalance($id,Request $request){
        $supplier=Supplier::with(['purchases'=>function($q) use ($request){
            $q->whereBetween('created_at',[$request->input('start_date'),$request->input('end_date')]);
        },'purchases.detailPurchases.product','purchases.detailPurchases.unit','purchases.purchases_payment.detail_purchases_payment'=>function($q) use ($request){
            $q->whereBetween('date',[$request->input('start_date'),$request->input('end_date')]);
        }])->findOrFail($id);

        return view("backend.supplier.report_balance")->withSupplier($supplier);
    }
    
}
