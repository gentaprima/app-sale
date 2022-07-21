<?php

namespace App\Http\Controllers;

use App\Models\ModelVoucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function show($voucher){
        $voucher = ModelVoucher::where('code_voucher',$voucher)->first();
        $status = true;
        if($voucher != null){
            if($voucher['is_use'] == 1){
                $status = false;
            }
        }
        return response()->json([
            'data' => $voucher,
            'status' => $status
        ]);
    }

    public function getVoucher($id){
        $data = ModelVoucher::where('id_users',$id)
                            ->where('is_use',0)
                            ->whereDate('expired_in','>=', date('Y-m-d'))
                            ->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
