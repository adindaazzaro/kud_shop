<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MObat;
use App\Traits\Helper;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    use Helper;
    public function obat()
    {
        $obat = MObat::all();
        return response()->json(['status' => 1, 'msg' => 'Success', 'data' => $obat]);
        
    }
    public function search_obat()
    {
        $keyword = (isset($_GET['q'])) ? $_GET['q'] : "";
        $kategori = (isset($_GET['k'])) ? $_GET['k'] : "";
        $obat = MObat::where('nama','like',"%{$keyword}%")
                ->whereHas('kategori',function ($query) use ($kategori)
                {
                    if($kategori != ""){
                        $query->where('id_kategori', $kategori);
                    }
                })
                ->get();
        return response()->json(['status' => 1, 'msg' => 'Success', 'data' => $obat]);
    }
}
