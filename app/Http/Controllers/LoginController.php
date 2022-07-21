<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(Request $request){
        $validate = Validator::make($request->all(),[
            'email' => 'required|email',
            'password'  => 'required'
        ],[
            'email.required' => "Email harus dilengkapi",
            'password.required' => "Password harus dilengkapi"
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Error !'); 
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors($validate);
        }

        $checkUsers = ModelUsers::where('email',$request->email)->first();
        if($checkUsers == null){
            Session::flash('message', 'Mohon maaf, Akun tidak ditemukan.'); 
            Session::flash('icon', 'warning'); 
            Session::flash('title', 'Warning !'); 
            return redirect()->back()
                            ->withInput($request->input());
        }

        if(!Hash::check($request->password, $checkUsers->password)){
            Session::flash('message', 'Mohon maaf, Email atau Password tidak sesuai.'); 
            Session::flash('icon', 'warning'); 
            Session::flash('title', 'Warning !'); 
            return redirect()->back()
                                ->withInput($request->input());
        }

        if($checkUsers->role == 1 || $checkUsers->role == 2){
            Session::put('dataUsers',$checkUsers);
            Session::put('isAdmin',true);
            Session::put('login', true);
            return redirect('/dashboard');
        }else{
            Session::put('dataUsers',$checkUsers);
            Session::put('isAdmin',false);
            Session::put('login', true);
            return redirect('/');
        }
    }
}
