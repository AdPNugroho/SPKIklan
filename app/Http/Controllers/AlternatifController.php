<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class AlternatifController extends Controller
{
    public function index(){
        return view('content.alternatif');
    }
    public function save(Request $request){
        if($request->ajax()){
            $insert = array();
            $insertMatriks = array();
            $get = $request->all();
            $data = array('nama_alternatif'=>$get['nama_alternatif']);
            $id = DB::table('tbl_alternatif')->insertGetId($data);
            $kriteria = DB::table('tbl_kriteria')->get();
            foreach($kriteria as $row){
                $idEvaluasi = DB::table('tbl_evaluasi')->insertGetId(array(
                    'id_alternatif'=>$id,
                    'id_kriteria'=>$row->id_kriteria,
                    'nilai_evaluasi'=>'1'
                ));
                $r = array(
                    'id_evaluasi'=>$idEvaluasi,
                    'nilai_matriks'=>1
                );
                array_push($insertMatriks,$r);
            }
            DB::table('tbl_matriks_saw')->insert($insertMatriks);
            DB::table('tbl_vektor_wp')->insert(array('id_alternatif'=>$id,'nilai_vektor_s'=>'1','nilai_vektor_v'=>'1'));
            DB::table('tbl_vektor_saw')->insert(array('id_alternatif'=>$id,'nilai_vektor_v'=>'1'));
            $response = array('message'=>'Data Alternatif Berhasil Di Input','status'=>'info','id'=>$id);
            return response()->json($response);
        }
    }
    public function getById(Request $request){
        if($request->ajax()){
            $alternatif = DB::table('tbl_alternatif')->where('id_alternatif','=',$request->id_alternatif)->first();
            $response = array(
                'id_alternatif'=>$alternatif->id_alternatif,
                'nama_alternatif'=>$alternatif->nama_alternatif
            );
            return response()->json($response);
        }
    }
    public function update(Request $request){
        if($request->ajax()){
            $data = array(
                'nama_alternatif'=>$request->nama_alternatif
            );
            DB::table('tbl_alternatif')->where('id_alternatif',$request->id_alternatif)->update($data);
            $response = array('message'=>'Data Alternatif Sudah Di Ubah','status'=>'info');
            return response()->json($response);
        }
    }
    public function delete(Request $request){
    }
    public function data(){
        $data = DB::table('tbl_alternatif')->get();
        return DataTables::of($data)->make(true);
    }
}
