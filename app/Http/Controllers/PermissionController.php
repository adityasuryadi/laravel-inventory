<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\DataTables\PermissionDataTable;

class PermissionController extends Controller
{
    
    public function index(PermissionDataTable $dataTable){
        $this->authorize('permission.create');
        $title="List Permission";
        return $dataTable->render('backend.permission.index',compact('title'));
    }

    public function create(){
        $this->authorize('permission.create');
        return view('backend.permission.create')
        ->withTitle('Create Permission');
    }

    public function store(Request $request){
        $this->validate($request,['name'=>'required'],['name.required'=>'Permisson Harus di isi']);
        $model = new Permission;
        $model->id = Str::uuid();
        $model->name = $request->input('name');
        $model->save();

        return redirect()->route('permission.index');
    }

    public function edit($id){
        $this->authorize('permission.edit');
        $model = Permission::findOrFail($id);
        return view('backend.permission.edit')
        ->withModel($model)
        ->withTitle('Edit '.$model->name);
    }

    public function update(Request $request,$id){
        $this->authorize('permission.edit');
        $this->validate($request,['name'=>'required'],['name.required'=>'Permisson Harus di isi']);
        $model = Permission::findOrFail($id);
        $model->name = $request->input('name');
        $model->save();

        return redirect()->route('permission.index');
    }

    public function destroy($id){
        $this->authorize('permission.delete');
        $model = Permission::findOrFail($id);
        $model->delete();

        return redirect()->route('permission.index');
    }
}
