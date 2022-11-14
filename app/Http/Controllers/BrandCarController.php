<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandCar;
use Auth;
use App\DataTables\BrandCarDataTable;

class BrandCarController extends Controller
{
    public function index(BrandCarDataTable $dataTable){
        $title = 'List Merk Mobil';
        return $dataTable->render('backend.brand_cars.index',compact('title'));
    }

    public function create(){
        return view('backend.brand_cars.create')
        ->withTitle('Merk Mobil');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Merk Mobil Harap di Isi'
        ]);

        $model = new BrandCar;
        $model->name = $request->input('name');
        $model->user_id = Auth::user()->id;
        $model->save();

        return redirect()->route('carbrands.index')->withSuccess(true)->withMessage('Data Berhasil Di simpan');
    }

    public function edit($id){
        $model = BrandCar::findOrFail($id);
        return view('backend.brand_cars.edit')
        ->withModel($model)
        ->withTitle('Edit Merk Mobil');
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Merk Mobil Harap di Isi'
        ]);

        $model = BrandCar::findOrFail($id);
        $model->name = $request->input('name');
        $model->user_id = Auth::user()->id;
        $model->save();

        return redirect()->route('carbrands.index')->withSuccess(true)->withMessage('Data Berhasil Di simpan');
    }

    public function destroy($id){
        $model = BrandCar::findOrFail($id);
        $model->delete();
        return redirect()->route('carbrands.index')->withDanger(true)->withMessage('Data Berhasil Di Hapus');
    }

    public function getBrands(){
        $brannds=BrandCar::with('car.carType')->get();
        return $brannds;
    }

}
