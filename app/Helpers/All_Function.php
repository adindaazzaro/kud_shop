<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class All_Function
{
    public static function toCurrency($money)
    {
        return number_format($money,0,",",".");
    }
    public static function convertDate($tgl, $tampil_hari = true, $with_menit = true)
    {
        if ($tgl != null ||  $tgl != "") {
            $nama_hari    =   array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
            $nama_bulan   =   array(
                1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            );
            $tahun        =   substr($tgl, 0, 4);
            $bulan        =   $nama_bulan[(int)substr($tgl, 5, 2)];
            $tanggal      =   substr($tgl, 8, 2);

            $text         =   "";

            if ($tampil_hari) {

                $urutan_hari  =   date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
                $hari         =   $nama_hari[$urutan_hari];
                $text         .=  $hari . ", ";
            }

            $text         .= $tanggal . " " . $bulan . " " . $tahun;

            if ($with_menit) {

                $jam    =   substr($tgl, 11, 2);
                $menit  =   substr($tgl, 14, 2);

                $text   .=  ", " . $jam . ":" . $menit;
            }
        } else {

            $text = "-";
        }
        return $text;
    }
}
