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
Route::get('/profile','HomeController@profile');
Route::get('/dashboard/data-produk','ProductController@index');
Route::post('/add-product','ProductController@store');
Route::post('/update-product/{id}','ProductController@update');
Route::get('/delete-product/{id}','ProductController@destroy');
Route::get('/dashboard/data-pelanggan','CustomersController@index');
Route::post('/dashboard/add-customers','CustomersController@store');
Route::post('/dashboard/update-customers/{id}','CustomersController@update');
Route::get('/dashboard/delete-customers/{id}','CustomersController@destroy');
Route::get('/dashboard/data-ekspedisi','ExpeditionController@index');
Route::post('/dashboard/add-expedition','ExpeditionController@store');
Route::post('/dashboard/update-expedition/{id}','ExpeditionController@update');
Route::get('/dashboard/delete-expedition/{id}','ExpeditionController@destroy');
Route::post('/update-profile/{id}','CustomersController@updateProfile');
Route::get('/dashboard/profile','DashboardController@profile');

Route::get('/logout',function(){
    Session::flush();
    return redirect('/');
});
