<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\ModelAlternatif;
use App\Models\ModelSubkriteria;
use App\Models\ModelUsers;
use App\Models\ModelVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    public function addTransction(Request $request)
    {
        $grandTotal = $request->grandTotal;
        if ($grandTotal == null) {
            $grandTotal = $request->subTotal;
        }

        $discount = $request->discount;
        if ($discount == null) {
            $discount = 0;
        } else {
            ModelVoucher::where('code_voucher', $request->kodeVoucher)
                ->update(['is_use' => 1]);
        }

        $dataTransaction = [];
        $imageTransaction = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $imageTransaction->getMimeType())[1];
        Storage::disk('uploads')->put('transaction/'.$filename,File::get($imageTransaction)); 
        if ($request->idUsers == null) {
            $idOrder = 'ORD-' . random_int(100000, 999999);
            for ($i = 0; $i < count($request->price); $i++) {

                $data = [
                    'id_order'  => $idOrder,
                    'full_name' => $request->fullName,
                    'email' => $request->email,
                    'phone_number' => $request->phoneNumber,
                    'alamat'    => $request->alamat,
                    'provinsi' => $request->provinsi,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'qty'   => $request->qty[$i],
                    'total'   => $request->total[$i],
                    'subtotal'   => $grandTotal,
                    'id_product' => $request->idProduct[$i],
                    'id_expedition' => $request->idExpedition,
                    'date'  => date('Y-m-d'),
                    'bukti_transaksi'   => $filename
                ];
                array_push($dataTransaction, $data);
            }

            DB::table('tbl_transaction_non_member')->insert($dataTransaction);
            $getDataCustomers = ModelUsers::where('email', $request->email)->first();
            $dataTransaction = DB::table('tbl_transaction_non_member')
                ->select('tbl_transaction_non_member.id_order', 'tbl_transaction_non_member.email', 'tbl_transaction_non_member.full_name', 'tbl_transaction_non_member.subtotal', 'tbl_transaction_non_member.date')
                ->where('email', '=', $request->email)
                ->whereMonth('date', '=', date('m'))
                ->groupBy('id_order', 'full_name', 'email', 'kecamatan', 'subtotal', 'date')
                ->get();
            $totalBelanja = 0;
            for ($i = 0; $i < count($dataTransaction); $i++) {
                $totalBelanja += $dataTransaction[$i]->subtotal;
            }

            // dd($dataTransaction);
            if ($totalBelanja >= 500000) {
                $users = ModelUsers::create([
                    'full_name' => $request->fullName,
                    'id_member' => 'M-' . random_int(100000, 999999),
                    'password' => Hash::make('1234'),
                    'role' => 0,
                    'phone_number'  => $request->phoneNumber,
                    'email'  => $request->email,
                    'alamat'  => $request->alamat,
                    'kecamatan'  => $request->kecamatan,
                    'kabupaten'  => $request->kabupaten,
                    'provinsi'  => $request->provinsi,
                ]);
                $users->save();
                Mail::to($request->email)->send(new SendEmail($request));
            }
        } else {
            $getDataCustomers = ModelUsers::where('email', $request->email)->first();
            $idOrder = 'ORD-' . random_int(100000, 999999);
            if ($request->idExpedition == 9) {
                $status = 2;
            } else {
                $status = 1;
            }
            for ($i = 0; $i < count($request->price); $i++) {
                $data = [
                    'id_order'  => $idOrder,
                    'id_users' => $getDataCustomers['id'],
                    'qty'   => $request->qty[$i],
                    'total'   => $request->total[$i],
                    'subtotal'   => $grandTotal,
                    'id_product' => $request->idProduct[$i],
                    'id_expedition' => $request->idExpedition,
                    'date'  => date('Y-m-d'),
                    'discount'  => $discount,
                    'status' => $status,
                    'rating' => 0,
                    'bukti_transaksi'   => $filename
                ];
                array_push($dataTransaction, $data);
            }
            DB::table('tbl_transaction_member')->insert($dataTransaction);

            //  tammbah voucer
            $descDiscout = '';
            $discount = '';

            if (intval($grandTotal) >= 1000000) {
                $descDiscout = 'Potongan Belanja sebesar Rp 100.000';
                $discount = '100000';
            } else if (intval($grandTotal) >= 650000) {
                $descDiscout = 'Potongan Belanja sebesar Rp 30.000';
                $discount = '30000';
            } else if (intval($grandTotal) >= 250000) {
                $descDiscout = 'Potongan Belanja sebesar Rp 10.000';
                $discount = '10000';
            }

            if (intval($grandTotal) >= 250000) {
                $expiredMonth = date('m') + 1;
                $vouhcer = ModelVoucher::create([
                    'code_voucher' => substr(str_shuffle(str_repeat($x = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(5 / strlen($x)))), 1, 5),
                    'total_discount'    => $discount,
                    'description' => $descDiscout,
                    'id_users' => $getDataCustomers['id'],
                    'is_use' => 0,
                    'expired_in' => date('Y-' . $expiredMonth . '-' . 'd')
                ]);
                $vouhcer->save();
            }

            // proses tambah nilai alternatif (member)
            $dataTransaction = DB::table('tbl_transaction_member')
                ->select('tbl_transaction_member.id_order', 'tbl_users.full_name', 'tbl_transaction_member.subtotal', 'date', 'id_expedition')
                ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
                ->leftJoin('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
                ->leftJoin('tbl_expedition', 'tbl_transaction_member.id_expedition', '=', 'tbl_expedition.id')
                ->where('id_users', '=', $getDataCustomers['id'])
                ->whereMonth('date', date('m'))
                ->groupBy('id_order', 'full_name', 'subtotal', 'date')
                ->orderBy('tbl_transaction_member.id', 'desc')
                ->get();

            $totalBelanja = 0;
            for ($i = 0; $i < count($dataTransaction); $i++) {
                $totalBelanja += $dataTransaction[$i]->subtotal;
            }
            $dataAmbilDiToko = DB::table('tbl_transaction_member')
                ->where('id_expedition', '=', 9)
                ->where('id_users', '=', $getDataCustomers['id'])
                ->whereMonth('date', date('m'))
                ->groupBy('id_order')
                ->orderBy('tbl_transaction_member.id', 'desc')
                ->get();
            $dataSameDay = DB::table('tbl_transaction_member')
                ->where('id_expedition', '=', 8)
                ->where('id_users', '=', $getDataCustomers['id'])
                ->whereMonth('date', date('m'))
                ->groupBy('id_order')
                ->orderBy('tbl_transaction_member.id', 'desc')
                ->get();

            $dataReguler = DB::table('tbl_transaction_member')
                ->where('id_expedition', '=', 7)
                ->where('id_users', '=', $getDataCustomers['id'])
                ->whereMonth('date', date('m'))
                ->groupBy('id_order')
                ->orderBy('tbl_transaction_member.id', 'desc')
                ->get();

            $expedisi = [
                '7' => count($dataReguler),
                '8' => count($dataSameDay),
                '9' => count($dataAmbilDiToko)
            ];
            $maxs = array_keys($expedisi, max($expedisi));

            if ($totalBelanja >= 500000 && count($dataTransaction) >= 5) {
                //masuk kriteria perhitungan pelanggan terbaik
                $subKriteriaTotalBelanja = DB::table('tbl_subkriteria')
                    ->where('jumlah', '<=', $totalBelanja)
                    ->where('id_kriteria', '2')
                    ->orderBy('jumlah', 'desc')
                    ->first();

                $subKriteriaVolumeBelanja =  DB::table('tbl_subkriteria')
                    ->where('jumlah', '<=', count($dataTransaction))
                    ->where('id_kriteria', '1')
                    ->orderBy('jumlah', 'desc')
                    ->first();

                $rating1 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 1)->get();
                $rating2 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 2)->get();
                $rating3 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 3)->get();
                $rating4 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 4)->get();
                $rating5 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 5)->get();
                $countTransaction = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', '>', 0)->get();


                if((1 * count($rating1)) + (2 * count($rating2)) + (3 * count($rating3)) + (4 * count($rating4)) + (5 * count($rating5)) != 0){
                   $countingRating = ((1 * count($rating1)) + (2 * count($rating2)) + (3 * count($rating3)) + (4 * count($rating4)) + (5 * count($rating5))) / count($countTransaction);
                }else{
                   $countingRating = 0;
                }


                $rating =  DB::table('tbl_subkriteria')
                    ->where('jumlah', '=', substr(round($countingRating, 0, PHP_ROUND_HALF_EVEN), 0, 1))
                    ->where('id_kriteria', '4')
                    ->first();


                $cekNilaiAlternatifCustomers = ModelAlternatif::where('id_users', $getDataCustomers['id'])->first();
                $dataAlternatif = [
                    'id_users' => $getDataCustomers['id'],
                    'volume_belanja' => $subKriteriaVolumeBelanja->id,
                    'total_belanja' => $subKriteriaTotalBelanja->id,
                    'ekspedisi' => $maxs[0],
                    'date'      => date('Y-m-d'),
                    'rating'    => $rating->id
                ];

                if ($cekNilaiAlternatifCustomers != null) {
                    ModelAlternatif::where('id_users', $getDataCustomers['id'])
                        ->update($dataAlternatif);
                } else {
                    $nilaiAlternatif = ModelAlternatif::create($dataAlternatif);
                    $nilaiAlternatif->save();
                }
            }
        }



        Session::flash('message', 'Data Pembelian berhasil ditambahkan.');
        Session::flash('icon', 'success');
        Session::flash('title', 'Success !');
        return redirect()->back()
            ->withInput();
    }


    public function show($id)
    {
        $data = DB::table('tbl_transaction_member')
            ->select('tbl_transaction_member.*', 'tbl_users.full_name', 'tbl_users.email', 'tbl_users.phone_number', 'tbl_users.alamat', 'tbl_users.kecamatan', 'tbl_users.kabupaten', 'tbl_users.provinsi', 'tbl_subkriteria.description')
            ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
            ->leftJoin('tbl_subkriteria', 'tbl_transaction_member.id_expedition', '=', 'tbl_subkriteria.id')
            ->where('id_order', '=', $id)
            ->first();

        return response()->json([
            'data' => $data
        ]);
    }

    public function detailOrder($id)
    {
        $data = DB::table('tbl_transaction_member')
            ->select('tbl_transaction_member.*', 'tbl_product.product_name', 'tbl_product.price')
            ->leftJoin('tbl_users', 'tbl_transaction_member.id_users', '=', 'tbl_users.id')
            ->leftJoin('tbl_product', 'tbl_transaction_member.id_product', '=', 'tbl_product.id')
            ->leftJoin('tbl_expedition', 'tbl_transaction_member.id_expedition', '=', 'tbl_expedition.id')
            ->where('id_order', '=', $id)
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function showNonMember($id)
    {
        $data = DB::table('tbl_transaction_non_member')
            ->select('tbl_transaction_non_member.*', 'tbl_expedition.expedition')
            ->leftJoin('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
            ->leftJoin('tbl_expedition', 'tbl_transaction_non_member.id_expedition', '=', 'tbl_expedition.id')
            ->where('id_order', '=', $id)
            ->first();

        return response()->json([
            'data' => $data
        ]);
    }

    public function detailOrderNonMember($id)
    {
        $data = DB::table('tbl_transaction_non_member')
            ->select('tbl_transaction_non_member.*', 'tbl_product.product_name', 'tbl_product.price')
            ->leftJoin('tbl_product', 'tbl_transaction_non_member.id_product', '=', 'tbl_product.id')
            ->leftJoin('tbl_expedition', 'tbl_transaction_non_member.id_expedition', '=', 'tbl_expedition.id')
            ->where('id_order', '=', $id)
            ->get();

        return response()->json([
            'data' => $data
        ]);
    }

    public function confirmOrder($id)
    {
        DB::table('tbl_transaction_member')->where('id_order', $id)->update(['status' => 2]);
        Session::flash('message', 'Data Pesanan berhasil dikonfirmasi.');
        Session::flash('icon', 'success');
        Session::flash('title', 'Success !');
        return redirect()->back()
            ->withInput();
    }

    public function addRating(Request $request, $id)
    {
        DB::table('tbl_transaction_member')
            ->where('id_order', $id)
            ->update([
                'rating'  => $request->rating,
                'ulasan'  => $request->ulasan
            ]);

        $getDataCustomers = ModelUsers::where('email', Session::get('dataUsers')->email)->first();

        $rating1 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 1)->get();
        $rating2 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 2)->get();
        $rating3 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 3)->get();
        $rating4 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 4)->get();
        $rating5 = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', 5)->get();
        $countTransaction = DB::table('tbl_transaction_member')->where('id_users', $getDataCustomers['id'])->where('rating', '>', 0)->get();

        $countingRating = ((1 * count($rating1)) + (2 * count($rating2)) + (3 * count($rating3)) + (4 * count($rating4)) + (5 * count($rating5))) / count($countTransaction);


        $rating =  DB::table('tbl_subkriteria')
            ->where('jumlah', '=', substr(round($countingRating, 0, PHP_ROUND_HALF_EVEN), 0, 1))
            ->where('id_kriteria', '4')
            ->first();


        $cekNilaiAlternatifCustomers = ModelAlternatif::where('id_users', $getDataCustomers['id'])->first();
        $dataAlternatif = [
            'rating'    => $rating->id
        ];
        if($cekNilaiAlternatifCustomers != null){
            ModelAlternatif::where('id_users', $getDataCustomers['id'])
            ->update($dataAlternatif);
        }

        Session::flash('message', 'Rating berhasil disimpan.');
        Session::flash('icon', 'success');
        Session::flash('title', 'Success !');
        return redirect()->back()
            ->withInput();
    }
}
