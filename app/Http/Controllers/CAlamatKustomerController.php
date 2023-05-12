<?php

namespace App\Http\Controllers;

use App\Models\MAlamatKustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CAlamatKustomerController extends Controller
{
    function index($id_kustomer){

        $title = "Alamat Pelanggan";
        $subTitle = "Kelola ".$title;
        // dd($id_kustomer);
        $alamat = MAlamatKustomer::where('id_kustomer',decrypt($id_kustomer))->with('kustomer')->get();
        return view('admin.pelanggan.alamat',compact('alamat','title','subTitle','id_kustomer'));
    }
    function create($id_kustomer)
    {
        $title = "Tambah Alamat Pelanggan";
        $subTitle = "Kelola ".$title;
        $create = true;
        $data = null;
        $url = route('admin.alamat.pelanggan.save');
        return view('admin.pelanggan.alamat-create',compact('title','subTitle','create','data','url','id_kustomer'));

    }
    function save(Request $request)
    {
        $id = request('id');
        $data = $request->except('_token');
        $data['id_kustomer'] = decrypt($data['id_kustomer']);
        if($id == null){
            MAlamatKustomer::create($data);
        }else{
            // dd($data);
            MAlamatKustomer::where('id',$id)->update($data);
        }
        return redirect(route('admin.alamat.pelanggan',$request->id_kustomer))->with('msg','Alamat di tambahkan');
    }
    function edit($id_kustomer,$id_alamat)
    {
        $title = "Edit Alamat Pelanggan";
        $subTitle = "Kelola ".$title;
        $create = false;
        $data = MAlamatKustomer::find(decrypt($id_alamat));
        $url = route('admin.alamat.pelanggan.save');
        return view('admin.pelanggan.alamat-create',compact('title','subTitle','create','data','url','id_kustomer'));
    }
    function delete($id_kustomer,$id_alamat){
        MAlamatKustomer::find(decrypt($id_alamat))->delete();
        return redirect(route('admin.alamat.pelanggan',$id_kustomer))->with('msg','Alamat di hapus');
    }
}
