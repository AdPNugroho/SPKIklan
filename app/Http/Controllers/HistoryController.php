<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class HistoryController extends Controller
{
    public function index(){
        return view('content.history');
    }
    public function detail(Request $request){
        if($request->ajax()){
            $dataSAW = DB::table('tbl_history')->join('tbl_history_saw','tbl_history.id_history','=','tbl_history_saw.id_history')->where('tbl_history.id_history',$request->id_history)->get();
            $dataWP = DB::table('tbl_history')->join('tbl_history_wp','tbl_history.id_history','=','tbl_history_wp.id_history')->where('tbl_history.id_history',$request->id_history)->get();
            foreach($dataSAW as $key=>$value){
                $alternatif[$key] = $value->nama_alternatif;
                $saw[$key] = $value->nilai_preferensi;
            }
            foreach($dataWP as $key=>$value){
                $wp[$key] = $value->nilai_preferensi;
            }
            $data = array(
                'nama_alternatif'=>$alternatif,
                'nilai_saw'=>$saw,
                'nilai_wp'=>$wp,
                'status'=>true
            );
            return response()->json($data);
        }
    }
    public function delete(Request $request){
        if($request->ajax()){
            DB::table('tbl_history')->where('id_history', '=',$request->id_history)->delete();
            return response()->json(array(
                'message'=>'Data History Sudah Terhapus',
                'status'=>'info'
            ));
        }
    }
    
    public function data(){
        $dataHistory = DB::table('tbl_history')->get();
        if(count($dataHistory)>0){
            foreach($dataHistory as $key=>$value){
                $saw = DB::table('tbl_history')->join('tbl_history_saw','tbl_history.id_history','=','tbl_history_saw.id_history')->orderBy('nilai_preferensi','DESC')->where('tbl_history.id_history',$value->id_history)->first();
                $wp = DB::table('tbl_history')->join('tbl_history_wp','tbl_history.id_history','=','tbl_history_wp.id_history')->orderBy('nilai_preferensi','DESC')->where('tbl_history.id_history',$value->id_history)->first();
                $returnHistory[$key] = array(
                    'id_history'=>$value->id_history,
                    'tanggal_simpan'=>$value->tanggal_simpan,
                    'nama_alternatif_wp'=>$wp->nama_alternatif,
                    'nama_alternatif_saw'=>$saw->nama_alternatif
                );
            }
        }else{
            $returnHistory = array();
        }
        return DataTables::of($returnHistory)->make(true);
    }
}
