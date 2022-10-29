<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HTransaksi extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $table = 'h_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = ['id_pelanggan','total_harga', 'jumlah_barang', 'tipe_pengambilan','created_at'];
    function detailTrans()
    {
        return $this->hasMany(HDetailTransaksi::class,'id_transaksi');
    }
    function pelanggan()
    {
        return $this->belongsTo(MPelanggan::class,'id_pelanggan');
    }
}
