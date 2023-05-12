<?php

namespace App\Traits;

use App\Models\HDetailTransaksi;
use App\Models\HTransaksi;
use App\Models\MAlamatKustomer;
use App\Models\MObat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait Transaksi{
    function tambahTransaksi(){
        $dataInsertDT = []; # Untuk Detail Transaksi
        $dataInsertT = []; # Untuk Detail Transaksi

        $obatBeli = request('obat_beli'); # Hrus Json
        $id_pelanggan = request('id_pelanggan'); # Hrus Json
        $id_alamat = request('id_alamat'); # Hrus Json

        $qty_total = 0;
        $harga_total = 0;
        $kodeTransaksi = Str::random(20);
        foreach (json_decode($obatBeli)->barang as $key) {
            $obat = MObat::where('id_obat',$key->id_obat)->first();
            $harga_total += $obat->harga;

            $data = [
                'id_obat'=>$key->id_obat,
                'jumlah'=>$key->qty,
                'kode_transaksi'=>$kodeTransaksi,
            ];
            $qty_total += $key->qty;
            array_push($dataInsertDT,$data);
        }
        $alamat_tujuan = MAlamatKustomer::find($id_alamat)->alamat;

        $dataInsertT = [
            'id_pelanggan' => $id_pelanggan,
            'kode_transaksi' => $kodeTransaksi,
            'jumlah_barang' => $qty_total,
            'total_harga' => $harga_total,
            'metode_kirim' => 1,
            'metode_bayar' => 1,
            'alamat_tujuan' => $alamat_tujuan,
        ];
        HDetailTransaksi::insert($dataInsertDT);
        HTransaksi::create($dataInsertT);
    }
}
