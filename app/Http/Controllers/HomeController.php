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
        return view('home/login');
    }

    public function profile()
    {
        return view('home/profile');
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
        return view('home/data-transaksi', $data);
    }

    public function dataVoucher()
    {
        $dataVoucher = ModelVoucher::where('id_users','=',Session::get('dataUsers')->id)
                                    ->get();

        $data = [
            'dataVoucher' => $dataVoucher
        ];
        return view('home/data-voucher', $data);
    }
}
