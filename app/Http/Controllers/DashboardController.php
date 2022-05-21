<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard/home');
    }

    public function login(){
        return view('dashboard/login');
    }

    public function profile(){
        return view('dashboard/profile');
    }
}
