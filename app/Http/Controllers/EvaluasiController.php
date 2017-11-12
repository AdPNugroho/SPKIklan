<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class EvaluasiController extends Controller
{
    public function index(){
        return view('content.evaluasi');
    }
    public function data(Request $request){
        $alternatif = DB::table('tbl_alternatif')->get();
        $kriteria = DB::table('tbl_kriteria')->get();

        $arrAlternatif = array();
        $arrKriteria = array();
        $arrEvaluasi = array();

        $x = 0;
        foreach($alternatif as $rowAlt){
            $y = 0;
            foreach($kriteria as $rowKr){
                $data = DB::table('tbl_evaluasi')
                        ->where('id_alternatif',$rowAlt->id_alternatif)
                        ->where('id_kriteria',$rowKr->id_kriteria)
                        ->first();
                $arrEvaluasi[$x][$y] = $data->nilai_evaluasi;
                $y++;
            }
            $x++;
        }
        $arrAlternatif = json_decode(json_encode($alternatif));
        $arrKriteria = json_decode(json_encode($kriteria));

        return response()->json(array(
            'kriteria'=>$arrKriteria,
            'alternatif'=>$arrAlternatif,
            'evaluasi'=>$arrEvaluasi
        ));
    }
    public function MatriksSAW(){
        $alternatif = DB::table('tbl_alternatif')->get();
        $kriteria = DB::table('tbl_kriteria')->get();

        $arrAlternatif = array();
        $arrKriteria = array();
        $arrEvaluasi = array();

        $x = 0;
        foreach($alternatif as $rowAlt){
            $y = 0;
            foreach($kriteria as $rowKr){
                $data = DB::table('tbl_evaluasi')
                        ->join('tbl_matriks_saw','tbl_evaluasi.id_evaluasi','=','tbl_matriks_saw.id_evaluasi')
                        ->where('id_alternatif',$rowAlt->id_alternatif)
                        ->where('id_kriteria',$rowKr->id_kriteria)
                        ->first();
                $arrEvaluasi[$x][$y] = $data->nilai_matriks;
                $y++;
            }
            $x++;
        }
        $arrAlternatif = json_decode(json_encode($alternatif));
        $arrKriteria = json_decode(json_encode($kriteria));

        return response()->json(array(
            'kriteria'=>$arrKriteria,
            'alternatif'=>$arrAlternatif,
            'evaluasi'=>$arrEvaluasi
        ));
    }
    public function getById(Request $request){
        if($request->ajax()){
            $kota = DB::table('tbl_kota_radius')->get();
            $alternatif = DB::table('tbl_alternatif')->where('id_alternatif',$request->id_alternatif)->first();
            $oplah = DB::table('tbl_evaluasi')->where('id_alternatif',$request->id_alternatif)->where('id_kriteria',1)->first();
            $radius = DB::table('tbl_evaluasi')->where('id_alternatif',$request->id_alternatif)->where('id_kriteria',2)->first();
            $jumlah = DB::table('tbl_evaluasi')->where('id_alternatif',$request->id_alternatif)->where('id_kriteria',3)->first();
            $harga = DB::table('tbl_evaluasi')->where('id_alternatif',$request->id_alternatif)->where('id_kriteria',4)->first();

            return response()->json(array(
                'kota'=>$kota,
                'alternatif'=>$alternatif,
                'oplah'=>$oplah->nilai_evaluasi,
                'radius'=>$radius->nilai_evaluasi,
                'jumlah'=>$jumlah->nilai_evaluasi,
                'harga'=>$harga->nilai_evaluasi,
            ));
        }
    }
}
