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
Route::get('/dashboard/add-transaction','DashboardController@addTransaction');
Route::get('/dashboard/get-customer-by-email/{email}','CustomersController@getDataByEmail');
Route::get('/dashboard/get-product-by-id/{id}','ProductController@show');
Route::get('/dashboard/get-all-product','ProductController@showAll');
Route::post('/dashboard/add-transaction','TransactionController@addTransction');
Route::get('/dashboard/data-transaction-non-member','DashboardController@dataTransactionNonMember');
Route::get('/dashboard/data-transaction-member','DashboardController@dataTransactionMember');
Route::get('/dashboard/get-detail-order/{id}','TransactionController@show');
Route::get('/dashboard/get-detail-order-all/{id}','TransactionController@detailOrder');
Route::get('/dashboard/get-detail-order-non-member/{id}','TransactionController@showNonMember');
Route::get('/dashboard/get-detail-order-all-non-member/{id}','TransactionController@detailOrderNonMember');
Route::get('/dashboard/checkVoucher/{voucher}','VoucherController@show');
Route::get('/dashboard/data-kriteria','DashboardController@dataKriteria');
Route::post('/dashboard/add-kriteria','CriteriaController@store');
Route::post('/dashboard/update-kriteria/{id}','CriteriaController@update');
Route::get('/dashboard/delete-kriteria/{id}','CriteriaController@destroy');
Route::get('/dashboard/data-subkriteria/{id}','DashboardController@dataSubKriteria');
Route::post('/dashboard/add-subkriteria','SubCriteriaController@store');
Route::post('/dashboard/update-subkriteria/{id}','SubCriteriaController@update');
Route::get('/dashboard/delete-subkriteria/{id}','SubCriteriaController@destroy');
Route::get('/dashboard/data-penilaian','DashboardController@dataPenilaian');
Route::get('/dashboard/data-perhitungan','DashboardController@dataPerhitungan');
Route::get('/dashboard/calculate-normalisasi','NormalisasiController@calcalulateNormalisasi');

Route::get('/logout',function(){
    Session::flush();
    return redirect('/');
});
