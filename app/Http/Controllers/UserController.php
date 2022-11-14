<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\DataTables\UserDataTable;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable){
        $this->authorize('user.create');
        $title = "List User";
        return $dataTable->render('backend.user.index',compact('title'));
    }

    public function create(){
        $this->authorize('user.create');
        $roles=Role::pluck('name','id');
        return view('backend.user.create')
        ->withTitle('Create User')
        ->withRoles($roles);
    }
    
    public function store(Request $request){
        $this->validate($request,[
            'user_name'=>'required',
            'name'=>'required',
            'password'=>'required|confirmed'
        ]);
        
        $model = new User;
        $model->id = Str::uuid();
        $model->name = $request->input('name');
        $model->user_name = $request->input('user_name');
        $model->password = bcrypt($request->input('password'));
        $model->save();

        $role_id=$request->input('role_id');
        $model->roles()->attach($role_id);
    }

    public function edit($id){
        $this->authorize('user.edit');
        $user = User::with('roles')->findOrFail($id);
        $roles=Role::pluck('name','id');
        return view('backend.user.edit')
        ->withTitle('Edit User')
        ->withModel($user)
        ->withRoles($roles);
    }

    public function update($id,Request $request){
        $this->authorize('user.edit');
        $user = User::with('roles')->findOrFail($id);
        $roles=Role::pluck('name','id');

        $role_id=$request->input('role_id');
        $user->roles()->sync($role_id);

        return view('backend.user.edit')
        ->withTitle('Edit User')
        ->withModel($user)
        ->withRoles($roles);
    }

    public function editProfile($id){
        if(! Auth::user()->id == $id){
            return abort('404');
        }
        $user=User::findOrFail($id);
        return view('backend.user.edit_profile')
        ->withModel($user)
        ->withTitle('Edit Profile '.$user->name);
    }

    public function updateProfile($id,Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ]);
        $user=User::findOrFail($id);
        $user->name=$request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('/');
    }
}
