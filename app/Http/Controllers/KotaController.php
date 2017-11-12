<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class KotaController extends Controller
{
    public function index(){
        return view('content.kota');
    }
    public function save(Request $request){
        if($request->ajax()){
            $get = $request->all();
            $data = array('nama_kota'=>$get['nama_kota'],'jumlah_penduduk'=>$get['jumlah_penduduk']);
            $id = DB::table('tbl_kota_radius')->insert($data);
            $response = array('message'=>'Data Kota Berhasil Di Input','status'=>'info');
            return response()->json($response);
        }
    }
    public function getById(Request $request){
        if($request->ajax()){
            $kotaRadius = DB::table('tbl_kota_radius')->where('id_kota_radius','=',$request->id_kota_radius)->first();
            $response = array(
                'id_kota_radius'=>$kotaRadius->id_kota_radius,
                'nama_kota'=>$kotaRadius->nama_kota,
                'jumlah_penduduk'=>$kotaRadius->jumlah_penduduk,
            );
            return response()->json($response);
        }
    }
    public function update(Request $request){
        if($request->ajax()){
            $data = array(
                'nama_kota'=>$request->nama_kota,
                'jumlah_penduduk'=>$request->jumlah_penduduk,
            );
            DB::table('tbl_kota_radius')->where('id_kota_radius',$request->id_kota_radius)->update($data);
            $response = array('message'=>'Data Kota Sudah Di Ubah','status'=>'info');
            return response()->json($response);
        }
    }
    public function delete(Request $request){
        if($request->ajax()){
            DB::table('tbl_kota_radius')->where('id_kota_radius', '=',$request->id_kota_radius)->delete();
            $response = array(
                'message'=>'Data Kota Berhasil Di Hapus',
                'status'=>'error'
            );   
            return response()->json($response);
        }
    }
    public function data(){
        $data = DB::table('tbl_kota_radius')->get();
        return DataTables::of($data)->make(true);
    }
}
