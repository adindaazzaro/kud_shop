<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKategoriObat extends Model
{
    use HasFactory,CreatedUpdatedBy;
    protected $table = 'tbl_kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = ['nama'];
    function obat()
    {
        return $this->hasOne(MObat::class, 'id_kategori');
    }
}
