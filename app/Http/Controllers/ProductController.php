<?php

namespace App\Http\Controllers;

use App\Models\ModelProduct;
use App\Models\ModelUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $dataProduct = ModelProduct::all();
        $data = [
            'dataProduct' => $dataProduct
        ];
        return view('dashboard/data-produk',$data);
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'productName' => 'required',
            'description'   => 'required',
            'price' => 'required|numeric',
            'image' => 'required'
        ],[
            'productName.required' => 'Nama Produk harus dilengkapi',
            'description.required' => 'Deskripsi harus dilengkapi',
            'price.required' => 'Harga harus dilengkapi',
            'price.numeric' => 'Harga harus angka',
            'image.required' => 'Foto harus dilengkapi',
            
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Error !'); 
            return redirect()->back()
                            ->withInput();
        }

        $imageProfile = $request->file('image');
        $filename = uniqid() . time() . "."  . explode("/", $imageProfile->getMimeType())[1];
        Storage::disk('uploads')->put('product/'.$filename,File::get($imageProfile)); 

        $product = ModelProduct::create([
            'product_name'  => $request->productName,
            'product_desc'  => $request->description,
            'price'  => $request->price,
            'image'  => $filename,
        ]);
        $product->save();
        Session::flash('message', 'Data Produk berhasil ditambahkan.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back()
                        ->withInput();

    }

    public function update(Request $request,$id){
        $validate = Validator::make($request->all(),[
            'productName' => 'required',
            'description'   => 'required',
            'price' => 'required|numeric'
        ],[
            'productName.required' => 'Nama Produk harus dilengkapi',
            'description.required' => 'Deskripsi harus dilengkapi',
            'price.required' => 'Harga harus dilengkapi',
            'price.numeric' => 'Harga harus angka',
            
        ]);

        if($validate->fails()){
            Session::flash('message', $validate->errors()->first()); 
            Session::flash('icon', 'error'); 
            Session::flash('title', 'Error !'); 
            return redirect()->back();
        }

        $product = ModelProduct::find($id);
        $imageProduct = $request->file('image');
        if($imageProduct == null){
            $filename = $product['image'];
        }else{

            $filename = uniqid() . time() . "."  . explode("/", $imageProduct->getMimeType())[1];
            Storage::disk('uploads')->put('product/'.$filename,File::get($imageProduct)); 
        }

        $product->product_name = $request->productName;
        $product->product_desc = $request->description;
        $product->price = $request->price;
        $product->image = $filename;
        $product->save();
        Session::flash('message', 'Data Produk berhasil diperbarui.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back();
    }

    public function destroy($id){
        $product = ModelProduct::find($id);
        $product->delete();
        Session::flash('message', 'Data Produk berhasil dihapus.'); 
        Session::flash('icon', 'success'); 
        Session::flash('title', 'Success !'); 
        return redirect()->back();
    }
}
