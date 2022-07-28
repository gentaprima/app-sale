<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\ModelExpedition;
use App\Models\ModelKriteria;
use App\Models\ModelProduct;
use App\Models\ModelSubkriteria;
use App\Models\ModelTransactionMember;
use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\CssSelector\Node\FunctionNode;

class DashboardController extends Controller
{
    public function index()
    {
        $data =  [
            'dataProduct' => ModelProduct::all(),
            'dataUsers' => DB::table('tbl_users')->where('role', '=', 0)->get(),
            'dataTransactionMember' => ModelTransactionMember::all()->groupBy('id_order'),
            'dataTransactionNonMember' => DB::table('tbl_transaction_non_member')->groupBy('id_order')->get(),
        ];
        return view('dashboard/home', $data);
    }

    public function login()
    {
        return view('dashboard/login');
    }

    public function profile()
    {
        return view('dashboard/profile');
    }

    public function addTransaction()
    {
        $dataMember = ModelUsers::where('role', 0)->get();
        $dataProduct = ModelProduct::all();
        $dataExpedition = DB::table('tbl_subkriteria')->where('id_kriteria', '=', 3)->get();
        $data = [
            'dataMember' => $dataMember,
            'dataProduct' => $dataProduct,
            'dataExpedition'    => $dataExpedition
        ];
        return view('dashboard/add-transaction', $data);
    }

    public function dataTransactionNonMember(Request $request)
    {
        $month = date('m');

        if ($request->month != null) {
            $splitMonth = explode('-', $request->month);
            $month = $splitMonth[1];
            $dataTransaction = DB::table('tbl_transaction_non_member')
                // ->selectRaw('count(*),id_order,full_name')
                ->select('tbl_transaction_non_member.id_order', 'tbl_transaction_non_member.full_name', 'tbl_transaction_non_member.subtotal', 'date', 'tbl_transaction_non_member.bukti_transaksi')
                ->leftJoin('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_expedition', 'tbl_transaction_non_member.id_expedition', '=', 'tbl_expedition.id')
                ->whereMonth('date', $splitMonth[1])
                ->groupBy('id_order', 'full_name', 'subtotal', 'date')
                ->orderBy('tbl_transaction_non_member.id', 'desc')
                ->get();
        } else {
            $dataTransaction = DB::table('tbl_transaction_non_member')
                // ->selectRaw('count(*),id_order,full_name')
                ->select('tbl_transaction_non_member.id_order', 'tbl_transaction_non_member.full_name', 'tbl_transaction_non_member.subtotal', 'date', 'tbl_transaction_non_member.bukti_transaksi')
                ->leftJoin('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_expedition', 'tbl_transaction_non_member.id_expedition', '=', 'tbl_expedition.id')
                ->whereMonth('date', date('m'))
                ->groupBy('id_order', 'full_name', 'subtotal', 'date')
                ->orderBy('tbl_transaction_non_member.id', 'desc')
                ->get();
        }




        $data = [
            'dataTransaction' => $dataTransaction,
            'filterMonth' => $request->month,
            'month' => date("F", mktime(0, 0, 0, $month, 10))
        ];
        return view('dashboard/data-transaction-non-member', $data);
    }
    public function dataTransactionMember(Request $request)
    {
        $month = date('m');

        if ($request->month != null) {
            $splitMonth = explode('-', $request->month);
            $month = $splitMonth[1];
            $dataTransaction = DB::table('tbl_transaction_member')
                ->join('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
                ->leftJoin('tbl_subkriteria', 'tbl_transaction_member.id_expedition', '=', 'tbl_subkriteria.id')
                ->select('tbl_transaction_member.*', DB::raw('GROUP_CONCAT(tbl_product.product_name) as product_name'), 'full_name', 'tbl_subkriteria.description as expedition', 'tbl_transaction_member.date', DB::raw('GROUP_CONCAT(tbl_transaction_member.qty) as qty'), 'subtotal')
                ->whereMonth('date', $splitMonth[1])
                ->orderBy('tbl_transaction_member.id', 'desc')
                ->groupBy('tbl_transaction_member.id_order')
                ->get();
        } else {
            $dataTransaction = DB::table('tbl_transaction_member')
                // ->selectRaw('count(*),id_order,full_name')
                ->select('tbl_transaction_member.id_order', 'tbl_users.full_name', 'tbl_transaction_member.subtotal', 'date', 'tbl_transaction_member.status', 'tbl_transaction_member.bukti_transaksi')
                ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
                ->leftJoin('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_expedition', 'tbl_transaction_member.id_expedition', '=', 'tbl_expedition.id')
                ->whereMonth('date', date('m'))
                ->groupBy('id_order', 'full_name', 'subtotal', 'date')
                ->orderBy('tbl_transaction_member.id', 'desc')
                ->get();
        }



        $data = [
            'dataTransaction' => $dataTransaction,
            'filterMonth' => $request->month,
            'month' => date("F", mktime(0, 0, 0, $month, 10))
        ];
        return view('dashboard/data-transaction-member', $data);
    }

    public function dataKriteria()
    {
        $dataKriteria = ModelKriteria::all();
        $data = [
            'dataKriteria' => $dataKriteria
        ];
        return view('dashboard/data-kriteria', $data);
    }

    public function dataSubkriteria($id)
    {
        $dataSubkriteria = ModelSubkriteria::where('id_kriteria', $id)->get();
        $dataKriteria = ModelKriteria::find($id);
        $data = [
            'dataSubkriteria' => $dataSubkriteria,
            'dataKriteria'    => $dataKriteria
        ];
        return view('dashboard/data-subkriteria', $data);
    }

    public function dataPenilaian()
    {
        $dataPenilaian = DB::table('tbl_nilai_alternatif')
            ->select('tbl_nilai_alternatif.*', 'a.description AS volume_belanja', 'b.description AS total_belanja', 'tbl_users.full_name', 'c.description AS ekspedisi', 'd.description AS rating')
            ->leftJoin('tbl_users', 'tbl_nilai_alternatif.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_subkriteria AS a', 'tbl_nilai_alternatif.volume_belanja', '=', 'a.id')
            ->leftJoin('tbl_subkriteria AS b', 'tbl_nilai_alternatif.total_belanja', '=', 'b.id')
            ->leftJoin('tbl_subkriteria AS c', 'tbl_nilai_alternatif.ekspedisi', '=', 'c.id')
            ->leftJoin('tbl_subkriteria AS d', 'tbl_nilai_alternatif.rating', '=', 'd.id')
            ->whereMonth('date', date('m'))
            ->get();
        $data = [
            'dataPenilaian' => $dataPenilaian
        ];
        return view('dashboard/data-penilaian', $data);
    }

    public function dataPerhitungan()
    {
        $dataPerhitungan = DB::table('tbl_normalisasi')
            ->select('tbl_normalisasi.*', 'tbl_users.full_name', 'tbl_users.email')
            ->leftJoin('tbl_nilai_alternatif', 'tbl_normalisasi.id_nilai_alternatif', '=', 'tbl_nilai_alternatif.id')
            ->leftJoin('tbl_users', 'tbl_nilai_alternatif.id_users', '=', 'tbl_users.id')
            ->orderBy('n_total', 'desc')
            ->get();
        $data = [
            'dataPerhitungan'   => $dataPerhitungan
        ];
        return view('dashboard/data-perhitungan', $data);
    }

    public function printFakturMember($id)
    {
        $dataTransaction = DB::table('tbl_transaction_member')
            ->select('tbl_transaction_member.id_order', 'tbl_users.full_name', 'tbl_transaction_member.subtotal', 'date', 'alamat', 'phone_number', 'kecamatan', 'kabupaten', 'provinsi', 'qty', 'product_name', 'total', 'subtotal', 'discount', 'price')
            ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
            ->leftJoin('tbl_expedition', 'tbl_transaction_member.id_expedition', '=', 'tbl_expedition.id')
            ->where('id_order', '=', $id)
            ->orderBy('tbl_transaction_member.id', 'desc')
            ->get();
        $data = [
            'dataTransaction' => $dataTransaction
        ];
        return view('dashboard/faktur', $data);
    }

    public function printFakturNonMember($id)
    {
        $dataTransaction = DB::table('tbl_transaction_non_member')
            ->leftJoin('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
            ->where('id_order', '=', $id)->get();
        $data = [
            'dataTransaction' => $dataTransaction
        ];
        return view('dashboard/faktur-non-member', $data);
    }

    public function report(Request $request)
    {
        $month = date('m');


        if ($request->month != null) {
            $splitMonth = explode('-', $request->month);
            $month = $splitMonth[1];
            $dataTransaction = DB::table('tbl_transaction_member')
                ->join('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
                ->leftJoin('tbl_subkriteria', 'tbl_transaction_member.id_expedition', '=', 'tbl_subkriteria.id')
                ->select('tbl_transaction_member.*', DB::raw('GROUP_CONCAT(tbl_product.product_name) as product_name'), 'full_name', 'tbl_subkriteria.description as expedition', 'tbl_transaction_member.date', DB::raw('GROUP_CONCAT(tbl_transaction_member.qty) as qty'), 'subtotal')
                ->whereMonth('date', $splitMonth[1])
                ->orderBy('tbl_transaction_member.id', 'desc')
                ->groupBy('tbl_transaction_member.id_order')
                ->get();
        } else {
            $dataTransaction = DB::table('tbl_transaction_member')
                ->join('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
                ->leftJoin('tbl_subkriteria', 'tbl_transaction_member.id_expedition', '=', 'tbl_subkriteria.id')
                ->select('tbl_transaction_member.*', DB::raw('GROUP_CONCAT(tbl_product.product_name) as product_name'), 'full_name', 'tbl_subkriteria.description as expedition', 'tbl_transaction_member.date', DB::raw('GROUP_CONCAT(tbl_transaction_member.qty) as qty'), 'subtotal')
                ->whereMonth('date', date('m'))
                ->orderBy('tbl_transaction_member.id', 'desc')
                ->groupBy('tbl_transaction_member.id_order')
                ->get();
        }
        $data = [
            'dataTransaction' => $dataTransaction,
            'filterMonth' => $request->month,
            'month' => date("F", mktime(0, 0, 0, $month, 10))
        ];
        return view('dashboard/report', $data);
    }
    public function reportNonMember(Request $request)
    {
        $month = date('m');

        if ($request->month != null) {
            $splitMonth = explode('-', $request->month);
            $month = $splitMonth[1];
            $dataTransaction = DB::table('tbl_transaction_non_member')
                ->join('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_subkriteria', 'tbl_transaction_non_member.id_expedition', '=', 'tbl_subkriteria.id')
                ->select('tbl_transaction_non_member.*', DB::raw('GROUP_CONCAT(tbl_product.product_name) as product_name'), 'full_name', 'tbl_subkriteria.description as expedition', 'tbl_transaction_non_member.date', DB::raw('GROUP_CONCAT(tbl_transaction_non_member.qty) as qty'), 'subtotal')
                ->whereMonth('date', $month)
                ->orderBy('tbl_transaction_non_member.id', 'desc')
                ->groupBy('tbl_transaction_non_member.id_order')
                ->get();
        } else {
            $dataTransaction = DB::table('tbl_transaction_non_member')
                ->join('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_subkriteria', 'tbl_transaction_non_member.id_expedition', '=', 'tbl_subkriteria.id')
                ->select('tbl_transaction_non_member.*', DB::raw('GROUP_CONCAT(tbl_product.product_name) as product_name'), 'full_name', 'tbl_subkriteria.description as expedition', 'tbl_transaction_non_member.date', DB::raw('GROUP_CONCAT(tbl_transaction_non_member.qty) as qty'), 'subtotal')
                ->whereMonth('date', $month)
                ->orderBy('tbl_transaction_non_member.id', 'desc')
                ->groupBy('tbl_transaction_non_member.id_order')
                ->get();
        }

        $data = [
            'dataTransaction' => $dataTransaction,
            'filterMonth' => $request->month,
            'month' => date("F", mktime(0, 0, 0, $month, 10))
        ];
        return view('dashboard/report-non-member', $data);
    }

    public function reportKonsumen()
    {
        
        $data['dataWinner'] = DB::table('tbl_pemenang')
            ->leftJoin('tbl_users', 'tbl_pemenang.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_hadiah','tbl_pemenang.bulan','=','tbl_hadiah.bulan')
            ->get();
        return view('dashboard/report-konsumen', $data);
    }

    public function getReward()
    {
        $dataReward = DB::table('tbl_hadiah')->get();
        $data = [
            'dataReward' => $dataReward
        ];
        return view('dashboard/data-reward', $data);
    }

    public function getPelayan()
    {
        $dataCustomers =  ModelUsers::where('role', 2)->get();
        $data = [
            'dataPelayan' => $dataCustomers
        ];
        return view('dashboard/data-pelayan', $data);
    }
}
