<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function register(){
        return view('user.auth.register');
    }
    public function postRegister(Request $request){
        $request->validate([
            'name'=>['required','string'],
            'email'=>['required','email','unique:users,email'],
            "password"=>['required'],
            "image" =>['required','mimes:png,jpg,jpeg']
        ]);

        //image upload
        $image= $request->file('image');
        $image_name = uniqid().$image->getClientOriginalName();
        $path = "image/$image_name";
        $image->storeAs($path);
        
        //database insert
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
            "image"=>$path,
        ]);

        //redirect
        return redirect()->route('login')->with("success","Register successfully. Please login with this account.");
    }
    public function login(){
        return view('user.auth.login');
    }
    public function postLogin(Request $request){
        $request->validate([
            "email"=>['required','email','exists:users,email'],
            "password"=>['required']
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('user.dashboard')->with('success',"Login successfully.");
        }else{
            return redirect()->back()->with('fail','Login failed.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success',"Logout Successfully.");
    }
}



