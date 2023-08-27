<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_keranjang';
    protected $table = 'keranjang';
    protected $fillable = ['id_pelanggan','id_obat', 'id_keranjang', 'qty'];
    function obat(){
        return $this->hasOne(MObat::class,'id_obat','id_obat');
    }
    function pelanggan(){
        return $this->hasOne(MPelanggan::class,'id_pelanggan','id_pelanggan');
    }

}
