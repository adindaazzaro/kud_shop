<?php

namespace App\Http\Controllers;

use App\Models\MKategoriObat;
use Illuminate\Http\Request;

class CKategori extends Controller
{

    public function index()
    {
        return view('admin.kategori-obat.index')
        ->with('title', 'Kategori Obat')
        ->with('subTitle', 'Kelola Kategori Obat');
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());

            MKategoriObat::create($request->except('_method', '_token'));
            return response()->json(['status' => true, 'msg' => 'Sukses Menambahkan Data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }

    public function show($id)
    {
        // dd(MKategoriObat::find($id));
        try {
            $kategoriobat = MKategoriObat::find(decrypt($id));
            $kategoriobat->key = encrypt($kategoriobat->id_kategori);
            return response()->json(['status' => true, 'data' => $kategoriobat->makeHidden('id_kategori')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }
    public function edit($id)
    {
        // dd(MKategoriObat::find($id));
        try {
            $kategoriobat = MKategoriObat::find(decrypt($id));
            $kategoriobat->key = encrypt($kategoriobat->id_kategori);
            return response()->json(['status' => true, 'data' => $kategoriobat->makeHidden('id_kategori')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }
    public function update($id, Request $request)
    {
        // dd(decrypt($id));
        try {
            MKategoriObat::find(decrypt($id))->update($request->except('_method', '_token'));
            return response()->json(['status' => true, 'msg' => 'Sukses Mengubah Data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try {
            MKategoriObat::find(decrypt($id))->delete();
            return response()->json(['status' => true, 'msg' => 'Sukses Menghapus Data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }
}
