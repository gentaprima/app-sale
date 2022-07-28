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
                                    ->where('is_use','=',0)
                                    ->orderBy('id','desc')
                                    ->get();
                                       

        $data = [
            'new_product'=> ModelProduct::limit(5)->get(),
            'dataVoucher' => $dataVoucher
        ];
        return view('home/data-voucher', $data);
    }

    public function keuntunganMenjadiMember(){
        return view('home/keuntungan-menjadi-member');
    }

    public function pemenangKonsumenTerbaik(){
        $monthNow = date('m');
        $yearNow = date('Y');

        $data['dataWinnerNow'] = DB::table('tbl_pemenang')
                                ->leftJoin('tbl_users','tbl_pemenang.id_users','=','tbl_users.id')
                                ->where('bulan',$monthNow)
                                ->where('tahun',$yearNow)
                                ->first();


        $data['listWinner'] = DB::table('tbl_pemenang')
                                ->leftJoin('tbl_users','tbl_pemenang.id_users','=','tbl_users.id')
                                ->get();


        $data['listReward'] = DB::table('tbl_hadiah')->get();
        

        return view('home/pemenang-konsumen-terbaik',$data);
    }
}

