<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(){
        return view('home/home');
    }
    
    public function login(){
        return view('home/login');
    }
}
