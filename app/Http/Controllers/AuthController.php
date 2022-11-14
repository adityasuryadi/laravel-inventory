<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('layouts.login');
    }

    public function authentication(Request $request){
        $this->validate($request,[
            'user_name'=>'required',
            'password'=>'required'],[
            'user_name.required'=>'User Name Harus di Isi'
            ]);

        $credentials = $request->only('user_name','password');
        if (Auth::attempt($credentials)){
            return redirect()->intended('/');
        }
        return redirect()->back()->withAlert(true)->withMessage('User name dan password salah');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
