<?php

namespace App\Http\Controllers;

use App\Models\ModelProduct;
use App\Models\ModelVoucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $data['product']= ModelProduct::limit(10)->get();
        $data['new_product'] = ModelProduct::limit(5)->get();
        
        return view('home/home',$data);
    }

    public function login()
    {
        $data['new_product'] = ModelProduct::limit(5)->get();
        return view('home/login',$data);
    }

    public function profile()
    {
        $data['new_product'] = ModelProduct::limit(5)->get();

        return view('home/profile',$data);
    }

    public function dataTransaction()
    {
        $dataTransaction = DB::table('tbl_transaction_member')
        ->leftJoin('tbl_expedition', 'tbl_transaction_member.id_expedition', '=', 'tbl_expedition.id')
        ->where('id_users','=',Session::get('dataUsers')->id)
        ->groupBy('id_order')
        ->orderBy('tbl_transaction_member.id', 'desc')
        ->get();
        
        $data = [
            'dataTransaction' => $dataTransaction
        ];
        $data['new_product'] = ModelProduct::limit(5)->get();
        return view('home/data-transaksi', $data);
    }

    public function dataVoucher()
    {
        $dataVoucher = ModelVoucher::where('id_users','=',Session::get('dataUsers')->id)
                                    ->get();
                                       

        $data = [
            'new_product'=> ModelProduct::limit(5)->get(),
            'dataVoucher' => $dataVoucher
        ];
        return view('home/data-voucher', $data);
    }
}
