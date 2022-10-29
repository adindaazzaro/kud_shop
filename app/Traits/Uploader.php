<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Uploader
{
    use Helper;
    public function uploadImage($dir, $file)
    {
        $result = null;
        $namaFile = time() . "_" . $this->generateRandomString(20) . "." . $file->extension();
        $file->move($dir, $namaFile);
        $result = $namaFile;
        return $result;
    }
}