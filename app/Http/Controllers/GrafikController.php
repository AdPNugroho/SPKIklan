<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
class GrafikController extends Controller
{
    public function index(){
        return view('content.grafik');
    }
    public function grafik(){
        $arrayLabel = array();
        $arrayWP = array();
        $arraySAW = array();
        $arrayS = array();
        $dataAlternatif = DB::table('tbl_alternatif')
            ->select('tbl_alternatif.nama_alternatif','tbl_vektor_saw.nilai_vektor_v as nilai_vektor_saw','tbl_vektor_wp.nilai_vektor_v as nilai_vektor_v','tbl_vektor_wp.nilai_vektor_s')
            ->join('tbl_vektor_wp','tbl_alternatif.id_alternatif','=','tbl_vektor_wp.id_alternatif')
            ->join('tbl_vektor_saw','tbl_alternatif.id_alternatif','=','tbl_vektor_saw.id_alternatif')
            ->get();
        if(count($dataAlternatif)>0){
            foreach($dataAlternatif as $rowAlternatif){
                $arrayWP[] = $rowAlternatif->nilai_vektor_v;
                $arraySAW[] = $rowAlternatif->nilai_vektor_saw;
                $arrayS[] = $rowAlternatif->nilai_vektor_s;
                $arrayLabel[] = $rowAlternatif->nama_alternatif;
            }
            return response()->json(array('categories'=>$arrayLabel,'saw'=>$arraySAW,'wp'=>$arrayWP,'status'=>true));
        }else{
            return response()->json(array('status'=>false));
        }
    }
    public function saveGrafik(){
        $data = DB::table('tbl_alternatif')
            ->select('tbl_alternatif.id_alternatif','tbl_alternatif.nama_alternatif','tbl_vektor_wp.nilai_vektor_s','tbl_vektor_wp.nilai_vektor_v as nilai_vektor_v_wp','tbl_vektor_saw.nilai_vektor_v as nilai_vektor_v_saw')
            ->join('tbl_vektor_wp','tbl_alternatif.id_alternatif','=','tbl_vektor_wp.id_alternatif')
            ->join('tbl_vektor_saw','tbl_alternatif.id_alternatif','=','tbl_vektor_saw.id_alternatif')
            ->get();
        $id = DB::table('tbl_history')->insertGetId(array('tanggal_simpan'=>Carbon::now()));
        foreach($data as $key=>$rowData){
            $wp[$key] = array(
                'id_history'=>$id,
                'nama_alternatif'=>$rowData->nama_alternatif,
                'nilai_preferensi'=>$rowData->nilai_vektor_v_wp
            );
            $saw[$key] = array(
                'id_history'=>$id,
                'nama_alternatif'=>$rowData->nama_alternatif,
                'nilai_preferensi'=>$rowData->nilai_vektor_v_saw
            );
        }
        DB::table('tbl_history_saw')->insert($saw);
        DB::table('tbl_history_wp')->insert($wp);
        return response()->json(array('message'=>'Data Vektor Sudah di Simpan','status'=>'info'));
    }
    public function chart(){
        $arrayLabel = array();
        $arrayWP = array();
        $arraySAW = array();
        $dataAlternatif = DB::table('tbl_alternatif')
            ->select('tbl_alternatif.nama_alternatif','tbl_vektor_saw.nilai_vektor_v as nilai_vektor_saw','tbl_vektor_wp.nilai_vektor_v as nilai_vektor_v')
            ->join('tbl_vektor_wp','tbl_alternatif.id_alternatif','=','tbl_vektor_wp.id_alternatif')
            ->join('tbl_vektor_saw','tbl_alternatif.id_alternatif','=','tbl_vektor_saw.id_alternatif')
            ->get();
        foreach($dataAlternatif as $rowAlternatif){
            $arrayWP[] = $rowAlternatif->nilai_vektor_v;
            $arraySAW[] = $rowAlternatif->nilai_vektor_saw;
            $arrayLabel[] = $rowAlternatif->nama_alternatif;
        }
        return response()->json(array('categories'=>$arrayLabel,'saw'=>$arraySAW,'wp'=>$arrayWP));
    }
    public function tableVektor(){
        $dataWP = DB::table('tbl_alternatif')->select('tbl_alternatif.id_alternatif','tbl_vektor_wp.nilai_vektor_v')->join('tbl_vektor_wp','tbl_alternatif.id_alternatif','=','tbl_vektor_wp.id_alternatif')->get();
        $dataSAW = DB::table('tbl_alternatif')->select('tbl_alternatif.id_alternatif','tbl_vektor_saw.nilai_vektor_v')->join('tbl_vektor_saw','tbl_alternatif.id_alternatif','=','tbl_vektor_saw.id_alternatif')->get();
        if(count($dataWP)>0){
            foreach($dataWP as $key=>$row){
                $nilai_vektor_v_wp[$key] = $row->nilai_vektor_v;
                $wp[$key] = array(
                    'id_alternatif'=>$row->id_alternatif,
                    'nilai_vektor_v'=>$row->nilai_vektor_v
                );
            }
            foreach($dataSAW as $key=>$row){
                $nilai_vektor_v_saw[$key] = $row->nilai_vektor_v;
                $saw[$key] = array(
                    'id_alternatif'=>$row->id_alternatif,
                    'nilai_vektor_v'=>$row->nilai_vektor_v
                );
            }
            array_multisort($nilai_vektor_v_wp,SORT_DESC,$wp);
            array_multisort($nilai_vektor_v_saw,SORT_DESC,$saw);
            foreach($wp as $key=>$value){
                $relateWP[$value['id_alternatif']] = array(
                    'rank'=>$key+1
                );
            }
            foreach($saw as $key=>$value){
                $relateSAW[$value['id_alternatif']] = array(
                    'rank'=>$key+1
                );
            }
            $dataTable = DB::table('tbl_alternatif')
                            ->select('tbl_alternatif.id_alternatif','tbl_alternatif.nama_alternatif','tbl_vektor_wp.nilai_vektor_s','tbl_vektor_wp.nilai_vektor_v as nilai_vektor_v_wp','tbl_vektor_saw.nilai_vektor_v as nilai_vektor_v_saw')
                            ->join('tbl_vektor_wp','tbl_alternatif.id_alternatif','=','tbl_vektor_wp.id_alternatif')
                            ->join('tbl_vektor_saw','tbl_alternatif.id_alternatif','=','tbl_vektor_saw.id_alternatif')
                            ->get();
            foreach($dataTable as $key=>$value){
                $dataReturn[$key] = array(
                    'id_alternatif'=>$value->id_alternatif,
                    'nama_alternatif'=>$value->nama_alternatif,
                    'nilai_vektor_s'=>$value->nilai_vektor_s,
                    'nilai_vektor_v_wp'=>$value->nilai_vektor_v_wp,
                    'ranking_wp'=>$relateWP[$value->id_alternatif]['rank'],
                    'nilai_vektor_v_saw'=>$value->nilai_vektor_v_saw,
                    'ranking_saw'=>$relateSAW[$value->id_alternatif]['rank']
                );
            }
        }else{
            $dataReturn = array();
        }
        return DataTables::of($dataReturn)->make(true);
    }
}
