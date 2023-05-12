<?php

namespace App\Http\Controllers;

use App\Models\HTansaksi;
use App\Models\HTransaksi;
use Illuminate\Http\Request;

class CHTransaksi extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Transaksi';
        $subTitle = 'Riwayat Transaksi';
        return view('admin.htransaksi.index',compact('title', 'subTitle'));
    }
    public function destroy($id_transaksi)
    {
        HTransaksi::find(decrypt($id_transaksi))->delete();
        return redirect(route('admin.transaksi'))->with('messages','Berhasil Menghapus');
    }
}
