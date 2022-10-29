<?php

namespace App\Http\Controllers;

use App\Models\MProfilApp;
use App\Traits\Uploader;
use Illuminate\Http\Request;

class CSettingApp extends Controller
{
    use Uploader;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function index()
    {
        $title = "Pengaturan Profile";
        $data = MProfilApp::first();
        return view('admin.pengaturan.index',compact('title', 'data'));
    }
    function saveUpdate(Request $request)
    {
        // dd($request->all());
        $data = $request->except('_token');
        $data['no_telp'] = "+".$request->no_telp;
        if($request->logo != null){
            $data['logo'] = $this->uploadImage(public_path('/image/setting'),$request->logo);
        }
        if($request->favicon != null){
            $data['favicon'] = $this->uploadImage(public_path('/image/setting'),$request->favicon);
        }
        MProfilApp::first()->update($data);
        return back()->with('msg','Sukses Update Pengaturan Aplikasi');
    }
}
