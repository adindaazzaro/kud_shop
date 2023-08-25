<?php

namespace App\Traits;

use App\Helpers\All_Function;
use App\Models\HDetailTransaksi;
use App\Models\HTransaksi;
use App\Models\Keranjang;
use App\Models\MAlamatKustomer;
use App\Models\MObat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait Transaksi{
    function tambahTransaksi(){

        $dataInsertDT = []; # Untuk Detail Transaksi
        $dataInsertT = []; # Untuk Detail Transaksi
        $totalBayar = 0;

        $obatBeli = request('obat_beli'); # Hrus Json
        $id_pelanggan = request('id_pelanggan');
        $id_alamat = request('id_alamat');
        $metode_kirim = request('metode_kirim');
        $metode_bayar = request('metode_bayar');

        $qty_total = 0;
        $harga_total = 0;
        $kodeTransaksi = $this->generateKodeTransaksi();

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
            $this->kurangiStokObat($key->id_obat,$key->qty);
        }
        $alamat_tujuan = MAlamatKustomer::find($id_alamat)->alamat;
        # Hitung Ongkir
        $ongkir = 0;
        if($metode_kirim == 2){
            $ongkir = 5000;
        }
        $dataInsertT = [
            'id_pelanggan' => $id_pelanggan,
            'kode_transaksi' => $kodeTransaksi,
            'jumlah_barang' => $qty_total,
            'total_harga' => $harga_total,
            'metode_kirim' => $metode_kirim,
            'metode_bayar' => $metode_bayar,
            'alamat_tujuan' => $alamat_tujuan,
            'no_pesan' => All_Function::generate_order_number(),
            'ongkir' => $ongkir,
        ];

        HDetailTransaksi::insert($dataInsertDT);
        HTransaksi::create($dataInsertT);
        $totalBayar = $harga_total+$ongkir;
        return $totalBayar;
    }
    function generateKodeTransaksi(){
        $kodeTransaksi = Str::random(20);
        $hTransaksi = HTransaksi::where('kode_transaksi',$kodeTransaksi)->first();
        if($hTransaksi != null){
            $this->generateKodeTransaksi();
        }
        return $kodeTransaksi;
    }
    function listTransaksi(){
        $idPelanggan = request()->query('id_pelanggan');
        $hTransaksi = HTransaksi::where('id_pelanggan',$idPelanggan)->get();
        return $hTransaksi;
    }
    function detailTransaksi(){
        $kodeTransaksi = request()->query('kode_transaksi');
        $hTransaksi = HTransaksi::where('kode_transaksi',$kodeTransaksi)->first();
        $hDetailTransaksi = HDetailTransaksi::where('kode_transaksi',$kodeTransaksi)->with('obat')->has('obat')->get();
        $barang = [];
        foreach ($hDetailTransaksi as $hdt) {
            array_push($barang,[
                'id_obat' => $hdt->obat?->id_obat,
                'nama' => $hdt->obat?->nama,
                'harga' => $hdt->obat?->harga,
                'jumlah' => $hdt->jumlah,
            ]);
        }
        $hTransaksi['barang'] = $barang;
        return $hTransaksi;
    }
    function kurangiStokObat($id_obat,$qty){
        $obat = MObat::where('id_obat',$id_obat)->first();
        $stokAsli = $obat->stok;
        $stok = $stokAsli - $qty;
        MObat::where('id_obat',$id_obat)->update(['stok'=>$stok]);
    }
    function hitungSubTotal($idPelanggan){
        return Keranjang::with('obat')
            ->where('id_pelanggan', $idPelanggan)
            ->get()
            ->sum(function ($item) {
                return $item->obat->harga * $item->qty;
            });
    }
}
