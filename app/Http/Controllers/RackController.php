<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rack;
use Auth;

class RackController extends Controller
{
    public function create(){
        return view('backend.rack.create')
        ->withTitle('Input Rak');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'Nama Rak Harap di Isi'
        ]);

        $model = new Rack;
        $model->name = $request->input('name');
        $model->user_id = Auth::user()->id;
        $model->save();

        return redirect()->route('rack.index')->withSuccess(true)->withMessage('Data Berhasil Di simpan');
    }

    public function getRacks(){
        $racks = Rack::all();
        return $racks;
    }
}
