<?php

namespace App\Http\Controllers;

use App\Models\ModelKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CriteriaController extends Controller
{
    public function store(Request $request){
        $criteria = ModelKriteria::create([
            'kriteria'  => $request->kriteria,
            'jenis'     => $request->jenis,
            'bobot'     => $request->bobot
        ]);

        $criteria->save();
        Session::flash('message', 'Data Kriteria berhasil ditambahkan.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function update(Request $request,$id){
        $criteria = ModelKriteria::find($id);
        $criteria->kriteria = $request->kriteria;
        $criteria->bobot = $request->bobot;
        $criteria->jenis = $request->jenis;
        $criteria->save();
        Session::flash('message', 'Data Kriteria berhasil diperbarui.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function destroy($id){
        $criteria = ModelKriteria::find($id);
        $criteria->delete();
        Session::flash('message', 'Data Kriteria berhasil dihapus.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function showKriteria($id){
         $dataNilaiAlternatif = DB::table('tbl_nilai_alternatif')
                                ->select('tbl_nilai_alternatif.id','SB1.description AS volume_belanja','SB2.description AS total_belanja','SB3.description AS ekspedisi','SB4.description AS rating')
                                ->leftJoin('tbl_users','tbl_nilai_alternatif.id_users','=','tbl_users.id')
                                ->leftJoin('tbl_subkriteria AS SB1','tbl_nilai_alternatif.volume_belanja','=','SB1.id')
                                ->leftJoin('tbl_subkriteria AS SB2','tbl_nilai_alternatif.total_belanja','=','SB2.id')
                                ->leftJoin('tbl_subkriteria AS SB3','tbl_nilai_alternatif.ekspedisi','=','SB3.id')
                                ->leftJoin('tbl_subkriteria AS SB4','tbl_nilai_alternatif.rating','=','SB4.id')
                                ->where('tbl_nilai_alternatif.id_users',$id)
                                ->first();

        return response()->json($dataNilaiAlternatif);
    }
}
