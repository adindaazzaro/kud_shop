<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MAlamatKustomer extends Model
{
    use HasFactory;
    protected $table = 'alamat_kustomer';
    public $timestamps = false;
    protected $fillable = ['id_kustomer','alamat','nama'];
    function kustomer()
    {
        return $this->hasOne(MPelanggan::class,'id_pelanggan','id_kustomer');
    }
}
