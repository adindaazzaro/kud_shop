<?php

namespace App\Traits;

use App\Models\MAlamatKustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

trait Customer{
    function createAlamat($id_kustomer)
    {
        $alamat = request('alamat');
        MAlamatKustomer::create(['alamat',$alamat]);
    }
    function updateAlamat($di_alamat)
    {
        $alamat = request('alamat');
        MAlamatKustomer::find($di_alamat)->update(['alamat',$alamat]);
    }
}
