<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KeranjangResource;
use App\Models\Keranjang;
use App\Traits\Helper;
use App\Traits\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    use Helper,Transaksi;
    function list(){
        try{
            $idPelanggan = request('id_pelanggan');
            $tipe = request('tipe'); # 1 all 2 Sepesific
            $idKeranjang = request('id_keranjang');
            $idKeranjang = explode(",",$idKeranjang);
            $keranjang = Keranjang::with('obat')->where([
                'id_pelanggan' => $idPelanggan,
            ]);
            if($tipe==2){
                $keranjang = $keranjang->whereIn('id_keranjang',[3,4]);

            }
            $keranjang = $keranjang->get();
            // dd($keranjang);
            $keranjang = KeranjangResource::collection($keranjang);
            $subTotal = $this->hitungSubTotal($idPelanggan);
            return response()->json($this->responseData(['message'=>'Sukses','data'=>$keranjang,'sub_total'=>$subTotal]));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
        }
    }
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
    function checkUnCheck(){
        try{
            $idObat = request('id_obat');
            $idPelanggan = request('id_pelanggan');
            $arrayIdObat = explode(",",$idObat);
            $subTotal = Keranjang::whereIn("id_obat",$arrayIdObat)
            ->where("id_pelanggan",$idPelanggan)
            ->get()
            ->sum(function ($item) {
                return (int)$item->obat?->harga * $item->qty;
            });
            $subTotal = $this->hitungSubTotal($idPelanggan);
            return response()->json($this->responseData(['sub_total'=>$subTotal]));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
        }

    }
}
