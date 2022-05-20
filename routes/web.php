<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index');
Route::get('/dashboard','DashboardController@index');
Route::get('/dashboard/login','DashboardController@login');
Route::get('/login','HomeController@login');
Route::post('/auth','LoginController@index');
Route::get('/logout',function(){
    Session::flush();
    return redirect('/');
});
