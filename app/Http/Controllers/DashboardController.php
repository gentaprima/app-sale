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

class DashboardController extends Controller
{
    public function index()
    {   
        $data =  [
            'dataProduct' => ModelProduct::all(),
            'dataUsers' => DB::table('tbl_users')->where('role','=',0)->get(),
            'dataTransactionMember' => ModelTransactionMember::all()->groupBy('id_order'),
            'dataTransactionNonMember' => DB::table('tbl_transaction_non_member')->groupBy('id_order')->get(),
        ];
        return view('dashboard/home',$data);
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
        $dataExpedition = ModelExpedition::all();
        $data = [
            'dataMember' => $dataMember,
            'dataProduct' => $dataProduct,
            'dataExpedition'    => $dataExpedition
        ];
        return view('dashboard/add-transaction', $data);
    }

    public function dataTransactionNonMember()
    {
        $dataTransaction = DB::table('tbl_transaction_non_member')
            // ->selectRaw('count(*),id_order,full_name')
            ->select('tbl_transaction_non_member.id_order', 'tbl_transaction_non_member.full_name', 'tbl_transaction_non_member.subtotal', 'date')
            ->leftJoin('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
            ->leftJoin('tbl_expedition', 'tbl_transaction_non_member.id_expedition', '=', 'tbl_expedition.id')
            ->groupBy('id_order', 'full_name', 'subtotal', 'date')
            ->orderBy('tbl_transaction_non_member.id', 'desc')
            ->get();

        $data = [
            'dataTransaction' => $dataTransaction
        ];
        return view('dashboard/data-transaction-non-member', $data);
    }
    public function dataTransactionMember()
    {
        $dataTransaction = DB::table('tbl_transaction_member')
            // ->selectRaw('count(*),id_order,full_name')
            ->select('tbl_transaction_member.id_order', 'tbl_users.full_name', 'tbl_transaction_member.subtotal', 'date')
            ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
            ->leftJoin('tbl_expedition', 'tbl_transaction_member.id_expedition', '=', 'tbl_expedition.id')
            ->groupBy('id_order', 'full_name', 'subtotal', 'date')
            ->orderBy('tbl_transaction_member.id', 'desc')
            ->get();

        $data = [
            'dataTransaction' => $dataTransaction
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
            ->select('tbl_nilai_alternatif.*', 'a.description AS volume_belanja', 'b.description AS total_belanja', 'tbl_users.full_name')
            ->leftJoin('tbl_users', 'tbl_nilai_alternatif.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_subkriteria AS a', 'tbl_nilai_alternatif.volume_belanja', '=', 'a.id')
            ->leftJoin('tbl_subkriteria AS b', 'tbl_nilai_alternatif.total_belanja', '=', 'b.id')
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
            ->get();

        $data = [
            'dataPerhitungan'   => $dataPerhitungan
        ];
        return view('dashboard/data-perhitungan', $data);
    }

    public function printFakturMember($id)
    {
        $dataTransaction = DB::table('tbl_transaction_member')
            ->select('tbl_transaction_member.id_order', 'tbl_users.full_name', 'tbl_transaction_member.subtotal', 'date','alamat','phone_number','kecamatan','kabupaten','provinsi','qty','product_name','total','subtotal','discount','price')
            ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
            ->leftJoin('tbl_expedition', 'tbl_transaction_member.id_expedition', '=', 'tbl_expedition.id')
            ->where('id_order','=',$id)
            ->orderBy('tbl_transaction_member.id', 'desc')
            ->get();
        $data = [
            'dataTransaction' => $dataTransaction
        ];
        return view('dashboard/faktur',$data);
    }

    public function printFakturNonMember($id){
        $dataTransaction = DB::table('tbl_transaction_non_member')
                            ->leftJoin('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
                            ->where('id_order','=',$id)->get();
        $data = [
            'dataTransaction' => $dataTransaction
        ];
        return view('dashboard/faktur-non-member',$data);
    }
}
