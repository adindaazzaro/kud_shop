<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Kelola Pengguna";
        $subTitle = $title;
        return view('admin.pengguna.index', compact('title', 'subTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Pengguna";
        $url = route('admin.pengguna.store');
        $data = null;
        $method = null;
        return view('admin.pengguna.form', compact('title', 'url', 'data', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUser $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect(route('admin.pengguna.index'))->with('msg', 'Sukses Menambahkan Pengguna');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $title = "Edit Pengguna";
        $url = route('admin.pengguna.update', $id);
        $data = User::find(decrypt($id));
        $method = method_field('PUT');
        return view('admin.pengguna.form', compact('title', 'url', 'data', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUser $request, $id)
    {
        $data = $request->safe()->except('password');
        if($request->password != null){
            $data['password'] = Hash::make($request->password);
        }
        // dd(decrypt($id));
        User::find(decrypt($id))->update($data);
        return redirect(route('admin.pengguna.index'))->with('msg', 'Sukses Mengubah Pengguna');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd(decrypt($id));
        try {
            //code...
            User::find(decrypt($id))->delete();
            return response()->json(['status' => true, 'msg' => 'Sukses Menghapus Pengguna']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
            //throw $th;
        }
    }
}
