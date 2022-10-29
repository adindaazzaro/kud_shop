<?php

namespace App\Http\Controllers;

use App\Models\HTansaksi;
use Illuminate\Http\Request;

class CHTransaksi extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $title = 'Transaksi';
        $subTitle = 'Riwayat Transaksi';
        return view('admin.htransaksi.index',compact('title', 'subTitle'));
    }
}
