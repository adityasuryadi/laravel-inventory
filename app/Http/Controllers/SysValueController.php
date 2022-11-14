<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\SysValue;

class SysValueController extends Controller
{
    public function getSysValue($name){
        $value=SysValue::where('name',$name)->get();
        return $value;
    }

    public function create(){
        return view('backend.sys_value.create')
        ->withTitle('Sys Value');
    }

    public function store(Request $request){
        $model = new SysValue;
        $model->id = Str::uuid();
        $model->name = $request->name;
        $model->value = $request->value;
        $model->save();
    }
}
