<?php

namespace App\Http\Controllers;

use App\Models\ModelSubkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubCriteriaController extends Controller
{
    public function store(Request $request){
        $criteria = ModelSubkriteria::create([
            'description'  => $request->subKriteria,
            'nilai_bobot'     => $request->nilaiSub,
            'id_kriteria'   => $request->idKriteria
        ]);

        $criteria->save();
        Session::flash('message', 'Data Subkriteria berhasil ditambahkan.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function update(Request $request,$id){
        $criteria = ModelSubkriteria::find($id);
        $criteria->description = $request->subKriteria;
        $criteria->nilai_bobot = $request->nilaiSub;
        $criteria->save();
        Session::flash('message', 'Data Subkriteria berhasil diperbarui.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function destroy($id){
        $criteria = ModelSubkriteria::find($id);
        $criteria->delete();
        Session::flash('message', 'Data Subkriteria berhasil dihapus.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }
}
