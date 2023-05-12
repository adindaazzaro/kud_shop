<?php

namespace App\Http\Controllers;

use App\Helpers\All_Function;
use App\Models\HTransaksi;
use App\Models\MKategoriObat;
use App\Models\MKritikSaran;
use App\Models\MMenu;
use App\Models\MObat;
use App\Models\MPages;
use App\Models\MPelanggan;
use App\Models\MProfilApp;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
class CDataTable extends Controller
{

    public function pengguna()
    {
        $model = User::query();
        // dd(Auth::user()->id);
        return DataTables::eloquent($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.pengguna.edit', encrypt($row->id)) . '" class="text-primary edit" tooltip="Edit Pengguna"><i class="fas fa-pencil-alt mr-2"></i></a>';
                if($row->id != 1){
                    $btn .= '<a href="' . route('admin.pengguna.destroy', encrypt($row->id)) . '" class="text-danger delete mr-2" tooltip="Hapus Pengguna"><i class="far fa-trash-alt"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function obat()
    {
        $model = MObat::with('kategori');
        // dd($model->get());
        return DataTables::eloquent($model)
            ->addColumn('kategori', function ($row) {
                return $row->kategori->nama;
            })
            ->editColumn('foto', function ($row) {
                if($row->foto == null){
                    return asset('assets/dist/img/logo-kud.png');
                }
                return asset('image/obat/' . $row->foto);
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.obat.edit', encrypt($row->id_obat)) . '" class="text-primary edit" tooltip="Edit Obat"><i class="fas fa-pencil-alt mr-2"></i></a>';
                $btn .= '<a href="' . route('admin.obat.destroy', encrypt($row->id_obat)) . '" class="text-danger delete mr-2" tooltip="Hapus Obat"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action', 'kategori'])
            ->addIndexColumn()
            ->toJson();
    }
    public function kategoriobat()
    {
        $model = MKategoriObat::query();
        // dd(Auth::user()->id);
        return DataTables::eloquent($model)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.kategori-obat.edit', encrypt($row->id_kategori)) . '" class="text-primary edit" tooltip="Edit Kategori Obat"><i class="fas fa-pencil-alt mr-2"></i></a>';
                $btn .= '<a href="' . route('admin.kategori-obat.destroy', encrypt($row->id_kategori)) . '" class="text-danger delete mr-2" tooltip="Hapus Kategori Obat"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function pelanggan()
    {
        $model = MPelanggan::query();
        // dd(Auth::user()->id);
        return DataTables::eloquent($model)
            ->addColumn('foto_conv', function ($row) {
                return '<img src="' . asset('image/pelanggan/' . $row->foto) . '" width="100px" alt="">';
            })
            ->editColumn('no_hp', function ($row) {
                return '+62'.$row->no_hp;
            })
            ->addColumn('alamat', function ($row) {
                $btn = '<a href="' . route('admin.alamat.pelanggan', encrypt($row->id_pelanggan)) . '" class="text-success edit" tooltip="Alamat Pelanggan"><i class="fas fa-map-marker-alt mr-2"></i> Alamat</a>';
                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.pelanggan.edit', encrypt($row->id_pelanggan)) . '" class="text-primary edit" tooltip="Edit Pelanggan"><i class="fas fa-pencil-alt mr-2"></i></a>';
                $btn .= '<a href="' . route('admin.pelanggan.destroy', encrypt($row->id_pelanggan)) . '" class="text-danger delete mr-2" tooltip="Hapus Pelanggan"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action', 'foto_conv','alamat'])
            ->addIndexColumn()
            ->toJson();
    }
    public function htransaksi()
    {   $setting = MProfilApp::first();
        $transaksi = HTransaksi::with('detailTrans','pelanggan');
        // dd($transaksi->get());
        return DataTables::eloquent($transaksi)
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('admin.transaksi.destroy', encrypt($row->id_transaksi)) . '" class="text-danger delete mr-2" tooltip="Hapus Kategori Obat"><i class="far fa-trash-alt"></i></a>';
                return $btn;
            })
            ->editColumn("total_harga",function ($row)
            {
                return All_Function::toCurrency($row->total_harga);
            })
            ->addColumn('nama_pelanggan', function ($row) {
                return $row->pelanggan->nama;
            })
            ->addColumn('detail', function ($row) use ($setting) {
                $html = '<h6 class="text-primary">Detail Transaksi</h6>';
                $html .= '<div class="row"><div class="col-md-8"><table class="w-100 table-striped"><tr><td>No<td>Kategori<td>Nama Obat<td>Harga<td>Jumlah<td>Total</td></tr>';
                        foreach ($row->detailTrans as $key => $value) {
                            $html .= '<tr>';
                            $html .= '<td>'.($key+1).'</td>';
                            $html .= '<td>'.$value->obat->kategori->nama.'</td>';
                            $html .= '<td>'.$value->obat->nama.'</td>';
                            $html .= '<td>'. All_Function::toCurrency($value->obat->harga).'</td>';
                            $html .= '<td>'. $value->jumlah.'</td>';
                            $html .= '<td>'. All_Function::toCurrency((int)$value->obat->harga*(int)$value->jumlah).'</td>';
                            $html .= '</tr>';
                        }
                $html .= '</table></div>';
                $html .= '<div class="col bg-dark rounded py-4">'.view('admin.htransaksi.struk',['data'=>$row,'setting'=> $setting])->render(). '</div></div>';
                return $html;
            })
            ->rawColumns(['action', 'nama_pelanggan', 'detail'])
            ->addIndexColumn()
            ->toJson();
    }

}
