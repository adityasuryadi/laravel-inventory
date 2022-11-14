<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WindShieldPart;
use Auth;

class WindShieldPartController extends Controller
{
    public function create(){
        return view('backend.wind_shield_part.create')
        ->withTitle('Input Bagian Kaca');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Bagian Kaca Harap di Isi'
        ]);

        $model = new WindShieldPart;
        $model->name = $request->input('name');
        $model->user_id = Auth::user()->id;
        $model->save();

        return redirect()->route('windshieldpart.index')->withSuccess(true)->withMessage('Data Berhasil Di simpan');
    }

    public function getParts(){
        $parts = WindShieldPart::all();
        return $parts;
    }
}
