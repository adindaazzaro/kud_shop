<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HTransaksi extends Model
{
    use HasFactory;
    protected $table = 'h_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_pelanggan','total_harga', 'kode_transaksi' ,'jumlah_barang', 'tipe_pengambilan','created_at','metode_kirim','metode_bayar','alamat_tujuan','bukti_transfer'];
    function detailTrans()
    {
        return $this->hasMany(HDetailTransaksi::class,'kode_transaksi','kode_transaksi');
    }
    function pelanggan()
    {
        return $this->belongsTo(MPelanggan::class,'id_pelanggan');
    }
}
