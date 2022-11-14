<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use App\DataTables\RoleDataTable;

class RoleController extends Controller
{
    public function index(RoleDataTable $dataTable){
        $this->authorize('role.create');
        $title="List Role";
        return $dataTable->render('backend.role.index',compact('title'));
    }

    public function create(){
        $this->authorize('role.create');
        $permissions=Permission::all();
        return view('backend.role.create')
        ->withTitle('Create Role')
        ->withPermissions($permissions);
    }

    public function store(Request $request){
        $model = new Role;
        $model->id = Str::uuid();
        $model->name = $request->input('name');
        $model->save();
        
        $permissions = $request->input('permission');
        $model->addPermission($permissions);
    }

    public function edit($id){
        $this->authorize('role.edit');
        $model = Role::with('permissions')->findOrFail($id);
        $permissions=Permission::all();
        return view('backend.role.edit')
        ->withModel($model)
        ->withTitle('Edit '.$model->name)
        ->withPermissions($permissions);
    }

    public function update(Request $request,$id){
        $this->authorize('role.edit');
        $model = Role::with('permissions')->findOrFail($id);
        $model->name = $request->input('name');
        $model->save();
        
        $permissions = $request->input('permission');
        $model->permissions()->sync($permissions);

        return redirect()->route('role.index');
    }
}
