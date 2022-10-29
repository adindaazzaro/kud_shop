<?php

namespace App\Http\Controllers;

use App\Models\MObat;
use App\Traits\Uploader;
use Illuminate\Http\Request;

class CObat extends Controller
{
    use Uploader;
    public function index()
    {
        return view('admin.obat.index')
        ->with('title', 'Obat')
        ->with('subTitle', 'Kelola Obat');
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $data = $request->except('_method', '_token');
            $data['harga'] = str_replace(".","",$request->harga);
            $data['foto'] = $this->uploadImage(public_path('image/obat'), $request->foto);
            MObat::create($data);
            return response()->json(['status' => true, 'msg' => 'Sukses Menambahkan Data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // dd(MObat::find($id));
        try {
            $obat = MObat::find(decrypt($id));
            $obat->key = encrypt($obat->id_obat);
            return response()->json(['status' => true, 'data' => $obat->makeHidden('id_obat')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        // dd(MObat::find($id));
        try {
            $obat = MObat::find(decrypt($id));
            $obat->key = encrypt($obat->id_obat);
            return response()->json(['status' => true, 'data' => $obat->makeHidden('id_obat')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }
    public function update($id, Request $request)
    {
        // dd($request->all());
        try {
            $data = $request->except('_method', '_token');
            $data['harga'] = str_replace(".", "", $request->harga);
            if (!empty($request->foto) || !is_null($request->foto)) {
                $data['foto'] = $this->uploadImage(public_path('image/obat'), $request->foto);
                if(!is_null($request['foto-old'])){
                    unlink(public_path('image/obat/' . $request['foto-old']));
                }
            }
            MObat::find(decrypt($id))->update($data);
            return response()->json(['status' => true, 'msg' => 'Sukses Mengubah Data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            MObat::find(decrypt($id))->delete();
            return response()->json(['status' => true, 'msg' => 'Sukses Menghapus Data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }
}
