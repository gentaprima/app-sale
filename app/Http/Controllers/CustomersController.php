<?php

namespace App\Http\Controllers;

use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    public function index(){
        $dataCustomers =  ModelUsers::where('role',0)->get();
        $data = [
            'dataCustomers' => $dataCustomers
        ];
        return view('dashboard/data-pelanggan',$data);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'fullName' => 'required',
            'email'   => 'required',
            'phoneNumber' => 'required|numeric',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
        ],[
            'fullName.required' => 'Nama Lengkap harus dilengkapi',
            'email.required' => 'Email harus dilengkapi',
            'phoneNumber.required' => 'No Telepon harus dilengkapi',
            'phoneNumber.numeric' => 'No Telepon harus angka',
            'alamat.required' => 'Alamat harus dilengkapi',
            'kecamatan.required' => 'Kecamatan harus dilengkapi',
            'kabupaten.required' => 'Kabupaten harus dilengkapi',
            'provinsi.required' => 'Provisni harus dilengkapi',
            
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Error !'); 
            return redirect()->back()
                            ->withInput();
        }

        $checkEmail = ModelUsers::where('email',$request->email)->first();
        if($checkEmail != null){
            Session::flash('message', 'Mohon maaf, email sudah digunakan.'); 
            Session::flash('icon', 'warning'); 
            Session::flash('title', 'Warning !'); 
            return redirect()->back()
                            ->withInput();
        }

        $users = ModelUsers::create([
            'full_name' => $request->fullName,
            'id_member' => 'M-'.random_int(100000, 999999),
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
        Session::flash('message', 'Data Pelanggan berhasil ditambahkan.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'fullName' => 'required',
            'email'   => 'required',
            'phoneNumber' => 'required|numeric',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
        ],[
            'fullName.required' => 'Nama Lengkap harus dilengkapi',
            'email.required' => 'Email harus dilengkapi',
            'phoneNumber.required' => 'No Telepon harus dilengkapi',
            'phoneNumber.numeric' => 'No Telepon harus angka',
            'alamat.required' => 'Alamat harus dilengkapi',
            'kecamatan.required' => 'Kecamatan harus dilengkapi',
            'kabupaten.required' => 'Kabupaten harus dilengkapi',
            'provinsi.required' => 'Provisni harus dilengkapi',
            
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Error !'); 
            return redirect()->back()
                            ->withInput();
        }

       $users = ModelUsers::find($id);
       $users->full_name = $request->fullName;
       $users->email = $request->email;
       $users->alamat = $request->alamat;
       $users->kecamatan = $request->kecamatan;
       $users->kabupaten = $request->kabupaten;
       $users->provinsi = $request->provinsi;
       $users->phone_number = $request->phoneNumber;
       $users->save();

        Session::flash('message', 'Data Pelanggan berhasil diperbarui.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }

    public function destroy($id){
        $users = ModelUsers::find($id);
        $users->delete();
        Session::flash('message', 'Data Pelanggan berhasil dihapus.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();
    }
}
