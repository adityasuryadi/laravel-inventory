<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Str;
use App\DataTables\CompanyDataTable;

class CompanyController extends Controller
{
    public function index(CompanyDataTable $dataTable){
        $this->authorize('company.create');
        $title = 'List Perusahaan';
        return $dataTable->render('backend.company.index',compact('title'));
    }

    public function create(){
        $this->authorize('company.create');
        return view('backend.company.create')->withTitle('Tambah Perusahaan');
    }

    public function store(Request $request){
        $this->validate($request,
        [
            'name'=>'required',
            'address'=>'required',
            'telp'=>'required|numeric'
        ],
        [
            'name.required'=>'Nama harus di isi',
            'address.required'=>'Alamat harus di isi',
            'telp.required'=>'No Telepon harus di isi',
            'telp.numeric'=>'No Telepon harus angka'
        ]);

        $model = new Company;
        $model->id = Str::uuid();
        $model->name = $request->input('name');
        $model->address = $request->input('address');
        $model->telp = $request->input('telp');
        $model->save();

        return redirect()->route('company.index');
    }

    public function edit($id){
        $this->authorize('company.edit');
        $model = Company::findOrFail($id);
        return view('backend.company.edit')
        ->withTitle('Edit Company')
        ->withModel($model);
    }

    public function update(Request $request,$id){
        $this->validate($request,
        [
            'name'=>'required',
            'address'=>'required',
            'telp'=>'required|numeric'
        ],
        [
            'name.required'=>'Nama harus di isi',
            'address.required'=>'Alamat harus di isi',
            'telp.required'=>'No Telepon harus di isi',
            'telp.numeric'=>'No Telepon harus angka'
        ]);

        $model = Company::findOrFail($id);
        $model->name = $request->input('name');
        $model->address = $request->input('address');
        $model->telp = $request->input('telp');
        $model->save();

        return redirect()->route('company.index');
    }

    public function getCompanies(){
        $companies=Company::all();
        return $companies;
    }

}
