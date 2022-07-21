<?php

namespace App\Http\Controllers;

use App\Models\ModelReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RewardController extends Controller
{
    public function store(Request $request){
        $splitMonth = explode('-',$request->month);
        $cekData = DB::table('tbl_hadiah')
                        ->where('bulan',$splitMonth[1])
                        ->where('tahun',$splitMonth[0])
                        ->first();
        if($cekData != null){
            Session::flash('message', 'Data Hadiah untuk bulan dan tahun tersebut sudah ada.'); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Success !'); 
            return redirect()->back()
                            ->withInput();  
        }
        $reward = ModelReward::create([
            'bulan' => $splitMonth[1],
            'tahun' => $splitMonth[0],
            'hadiah'    => $request->hadiah
        ]);

        $reward->save();

        Session::flash('message', 'Data Hadiah berhasil ditambahkan.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();  
    }

    public function update(Request $request,$id){
        $splitMonth = explode('-',$request->month);
        DB::table('tbl_hadiah')->where('id',$id)->update([
            'bulan' => $splitMonth[1],
            'tahun' => $splitMonth[0],
            'hadiah'    => $request->hadiah
        ]);

        Session::flash('message', 'Data Hadiah berhasil diperbarui.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();  
    }

    public function destroy($id){
        $reward = ModelReward::find($id);
        $reward->delete();
        Session::flash('message', 'Data Hadiah berhasil dihapus.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();  
    }
}
