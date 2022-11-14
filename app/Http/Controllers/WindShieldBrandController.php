<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WindShieldBrand;
use Auth;

class WindShieldBrandController extends Controller
{
    public function create(){
        return view('backend.wind_shield_brand.create')
        ->withTitle('Input Merk Kaca');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Merk Kaca Harap di Isi'
        ]);

        $model = new WindShieldBrand;
        $model->name = $request->input('name');
        $model->user_id = Auth::user()->id;
        $model->save();

        return redirect()->route('windshieldpart.index')->withSuccess(true)->withMessage('Data Berhasil Di simpan');
    }

    public function getBrands(){
        $brands = WindShieldBrand::all();
        return $brands;
    }
}
