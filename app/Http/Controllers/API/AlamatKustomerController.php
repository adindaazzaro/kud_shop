<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MAlamatKustomer;
use Illuminate\Http\Request;

class AlamatKustomerController extends Controller
{
    function list(){
        try {
            $id_kustomer = request('id_kustomer');
            $data = MAlamatKustomer::where('id_kustomer',$id_kustomer)->get();
            return response()->json(['status' => 1, 'msg' => 'Success', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage(), 'data' => null]);        }
    }
}
