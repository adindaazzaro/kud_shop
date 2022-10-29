<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MProfilApp extends Model
{
    use HasFactory;
    protected $table = 'm_profil_app';
    protected $primaryKey = 'id_profil_app';
    public $timestamps = false;
    protected $fillable = ['nama', 'logo', 'no_telp', 'email', 'facebook', 'instagram', 'tiktok', 'youtube', 'whatsapp', 'telegram','favicon'];
    
}
