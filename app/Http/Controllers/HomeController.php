<?php

namespace App\Http\Controllers;

use App\Models\ModelTransactionMember;
use App\Models\ModelVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('home/home');
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
