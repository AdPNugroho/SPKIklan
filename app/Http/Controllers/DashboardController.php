<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    public function index(){
        $dataWP = DB::table('tbl_alternatif')->join('tbl_vektor_saw','tbl_alternatif.id_alternatif','=','tbl_vektor_saw.id_alternatif')->orderBy('nilai_vektor_v','desc')->limit(1)->first();
        $dataSAW = DB::table('tbl_alternatif')->join('tbl_vektor_wp','tbl_alternatif.id_alternatif','=','tbl_vektor_wp.id_alternatif')->orderBy('nilai_vektor_v','desc')->limit(1)->first();
        $alternatif = DB::table('tbl_alternatif')->count();
        (count($dataWP)>0 ? $wp = $dataWP->nama_alternatif : $wp = "Tidak Ada Data Alternatif");
        (count($dataSAW)>0 ? $saw = $dataSAW->nama_alternatif : $saw = "Tidak Ada Data Alternatif");
        $data = array(
            'alternatif'=>$alternatif,
            'wp'=>$wp,
            'saw'=>$saw
        );
        return view('content.dashboard',$data);
    }
}
