<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MKategoriObat;
use App\Models\MObat;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Mockery\Undefined;

class ObatController extends Controller
{
    use Helper;
    public function obat()
    {
        try {
            $obat = MObat::all();
            return response()->json($this->responseData($obat));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));
            //throw $th;
        }


    }
    public function search_obat()
    {
        try{
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
            return response()->json($this->responseData($obat));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));

            //throw $th;
        }
    }
    function kategoriObat()
    {
        try{
            $kategori = MKategoriObat::select('id_kategori', 'nama')->get();
            return response()->json($this->responseData($kategori));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));

            //throw $th;
        }
    }
    function detailObat(){
        try{
            $id_obat = request()->query('id_obat');
            $data = MObat::find($id_obat);
            return response()->json($this->responseData($data));
        } catch (\Throwable $th) {
            return response()->json($this->responseData(null,$th->getMessage(),500));

            //throw $th;
        }
    }
}
