<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>['required','email','exists:users,email'],
            "password"=>['required']
        ]);
        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('admin.dashboard')->with('success',"Welcome to Admin Panel.");
        }else{
            return redirect()->back()->with('fail',"You don't have permission.");
        };
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
