<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelangganRequest;
use App\Models\MPelanggan;
use App\Traits\Helper;
use App\Traits\Uploader;
use Illuminate\Support\Facades\Hash;

class CPelanggan extends Controller
{
    use Helper,Uploader;
    public function index()
    {
        $url = route('admin.pelanggan.create');
        $title = "Pelanggan";
        $subTitle = "Kelola ".$title;
        $data = MPelanggan::all();
        return view('admin.pelanggan.index', compact('url', 'title','subTitle', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $url = route('admin.pelanggan.store');
        $title = "Tambah Pelanggan";
        $data = null;
        $method = null;
        return view('admin.pelanggan.form', compact('url', 'title', 'data', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PelangganRequest $request)
    {

        $data = $request->safe()->except(['_token','_method']);
        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = Hash::make('12345');
        }
        if ($request->hasFile('foto')) {
            $data['foto'] = $this->uploadImage(public_path('image/pelanggan'), $request->foto);
        }
        MPelanggan::create($data);
        return redirect(route('admin.pelanggan.index'))->with('msg', 'Sukses Menambah Pelanggan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MPelanggan  $mPelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = route('admin.pelanggan.edit' . $id);
        $title = "Detail Pelanggan";
        return view('admin.pelanggan.form', compact('url', 'title'))->with('data', MPelanggan::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MPelanggan  $mPelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $method = method_field('PUT');
        $url = route('admin.pelanggan.update', $id);
        $title = "Edit Pelanggan";
        return view('admin.pelanggan.form', compact('url', 'title', 'method'))->with('data', MPelanggan::find(decrypt($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MPelanggan  $mPelanggan
     * @return \Illuminate\Http\Response
     */
    public function update($id, PelangganRequest $request)
    {
        // dd("sadas");
        $data = $request->except(['email','password']);


        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('foto')) {
            if (file_exists(public_path('image/pelanggan/' . $request['foto-old']))) {
                unlink(public_path('image/pelanggan/' . $request['foto-old']));
            };
            $data['foto'] = $this->uploadImage(public_path('image/pelanggan'), $request->foto);
        }

        MPelanggan::find(decrypt($id))->update($data);
        return redirect(route('admin.pelanggan.index'))->with('msg', 'Sukses Mengubah Pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MPelanggan  $mPelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pelanggan = MPelanggan::find(decrypt($id));
            if(file_exists(public_path('image/pelanggan/' . $pelanggan->foto))){
                unlink(public_path('image/pelanggan/' . $pelanggan->foto));
            };
            $pelanggan->updateDeleted($id);
            return response()->json(['status' => true, 'msg' => 'Sukses Menghapus Data'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()], 500);
        }
    }

}
