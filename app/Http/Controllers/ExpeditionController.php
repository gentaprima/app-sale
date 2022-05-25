<?php

namespace App\Http\Controllers;

use App\Models\ModelExpedition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ExpeditionController extends Controller
{
    public function index(){
        $dataExpedisi = ModelExpedition::all();
        $data = [
            'dataExpedisi' => $dataExpedisi
        ];
        return view('dashboard/data-ekspedisi',$data);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'expedition' => 'required',
            'bobot' => 'required',
        ],[
            'expedition.required' => 'Nama Ekspedisi harus dilengkapi',
            'bobot.required' => 'Bobot harus dilengkapi',
            
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Error !'); 
            return redirect()->back()
                            ->withInput();
        }

        $expedition = ModelExpedition::create([
            'expedition'    => $request->expedition,
            'bobot'    => $request->bobot
        ]);
        $expedition->save();
        Session::flash('message', 'Data Ekspedisi berhasil ditambahkan.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'expedition' => 'required',
            'bobot' => 'required',
        ],[
            'expedition.required' => 'Nama Ekspedisi harus dilengkapi',
            'bobot.required' => 'Bobot harus dilengkapi',
            
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Error !'); 
            return redirect()->back()
                            ->withInput();
        }

        $expedition = ModelExpedition::find($id);
        $expedition->expedition = $request->expedition;
        $expedition->bobot = $request->bobot;
        $expedition->save();
        Session::flash('message', 'Data Ekspedisi berhasil diperbarui.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function destroy($id){
        $expedition = ModelExpedition::find($id);
        $expedition->delete();
        Session::flash('message', 'Data Ekspedisi berhasil dihapus.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }
}
