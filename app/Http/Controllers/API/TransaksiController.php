<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HTransaksi;
use Illuminate\Support\Facades\DB;
use App\Traits\Transaksi;
use App\Traits\Uploader;

class TransaksiController extends Controller
{

    use Transaksi, Uploader;
    public $kodeTransaksi = null;
    public function create()
    {
        try {

            DB::transaction(function () {
                $this->kodeTransaksi = $this->tambahTransaksi();
            });
            DB::commit();
            return response()->json(['status' => 1, 'msg' => 'Success','data' => $this->kodeTransaksi]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 0, 'msg' => $th->getMessage()]);
        }
    }
    function uploadBuktiTransfer(){
        try {
            $kodeTransaksi = request('kode_transaksi');
            $buktiTransfer = request('bukti_transfer');
            $path = 'image/bukti_transfer';
            $namaFile = $path."/".$this->uploadImage(public_path($path),$buktiTransfer);
            $hTransaksi = HTransaksi::where('kode_transaksi',$kodeTransaksi)->first();
            $hTransaksi->bukti_transfer = $namaFile;
            $hTransaksi->update();
            return response()->json(['status' => 1, 'msg' => 'Success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()]);
        }
    }
    function listTransaksiPelanggan(){
        try {
            $data = $this->listTransaksi();
            return response()->json(['status' => 1, 'msg' => 'Success','data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()]);
        }
    }
    function detailTransaksiPelanggan(){
        try {
            $data = $this->detailTransaksi(); # Req kode_transaksi
            return response()->json(['status' => 1, 'msg' => 'Success','data'=>$data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'msg' => $th->getMessage()]);
        }
    }

}
