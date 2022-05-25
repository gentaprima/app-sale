<?php

namespace App\Http\Controllers;

use App\Models\ModelKriteria;
use Illuminate\Http\Request;
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
}
