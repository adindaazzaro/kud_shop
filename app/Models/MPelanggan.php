<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPelanggan extends Model
{
    use HasFactory, CreatedUpdatedBy;
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = ['email', 'password', 'nama', 'alamat', 'no_hp', 'foto','deleted'];
    function generatePhotos($class = '')
    {
        $img = '<img class="' . $class . '" src="' . url('image/pelanggan/') . $this->foto . '" alt="' . $this->nama . '">';
        return $img;
    }
    public static function withDeleted()
    {
        return self::where('deleted', 1);
    }
    public static function updateDeleted($id)
    {
        $pegawai = self::find(decrypt($id));
        return $pegawai->update(['deleted' => 0]);
    }
    function htransaksi()
    {
        return $this->hasOne(HTransaksi::class, 'id_pelanggan');
    }
}
