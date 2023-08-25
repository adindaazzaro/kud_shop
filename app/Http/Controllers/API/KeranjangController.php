<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Traits\Helper;
use App\Traits\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    use Helper,Transaksi;
    function store(){
        try{
            $idPelanggan = request('id_pelanggan');
            $idObat = request('id_obat');
            $qty = request('qty');

            Keranjang::updateOrCreate([
                'id_pelanggan' => $idPelanggan,
                'id_obat' => $idObat
            ],[
                'qty' => $qty,
            ]);
            return response()->json($this->responseData(['message'=>'Sukses tambah ke keranjang']));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
        }
    }
    function tambahKurang(){
        try{
            $idPelanggan = request('id_pelanggan');
            $idObat = request('id_obat');
            $status = request('status');

            $keranjang = Keranjang::where(['id_pelanggan'=>$idPelanggan,'id_obat'=>$idObat])->first();
            // dd($keranjang);
            if($keranjang){
                if($status == 1){
                    $keranjang->increment('qty');
                }elseif($status == 2){
                    $keranjang->decrement('qty');
                }
            }
            $subTotal = $this->hitungSubTotal($idPelanggan);
            return response()->json($this->responseData(['sub_total'=>$subTotal]));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
        }
    }
    function delete(){
        try{
            $idPelanggan = request('id_pelanggan');
            $idObat = request('id_obat');
            Keranjang::where(['id_obat'=>$idObat])->delete();
            $subTotal = $this->hitungSubTotal($idPelanggan);
            return response()->json($this->responseData(['sub_total'=>$subTotal]));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
        }
    }
}
