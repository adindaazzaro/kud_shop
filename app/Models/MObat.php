<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class MObat extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $table = 'm_obat';
    protected $primaryKey = 'id_obat';
    protected $fillable = ['nama', 'harga', 'stok', 'deskripsi', 'id_kategori','foto'];
    
    function hdetailtransaksi()
    {
        return $this->hasMany(HDetailTransaksi::class,'id_obat');
    }
    function kategori()
    {
        return $this->belongsTo(MKategoriObat::class,'id_kategori');
    }
    
}
