<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HDetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $fillable = ['id_obat','kode_transaksi', 'jumlah'];
    function transaksi()
    {
        return $this->belongsTo(HTansaksi::class,'kode_transaksi','kode_transaksi');
    }
    function obat()
    {
        return $this->belongsTo(MObat::class,'id_obat');
    }
}
