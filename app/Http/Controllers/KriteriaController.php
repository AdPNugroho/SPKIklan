<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
class KriteriaController extends Controller
{
    public function index(){
        return view('content.kriteria');
    }
    public function getById(Request $request){
        if($request->ajax()){
            $kriteria = DB::table('tbl_kriteria')->where('id_kriteria','=',$request->id_kriteria)->first();
            $response = array(
                'id_kriteria'=>$kriteria->id_kriteria,
                'nama_kriteria'=>$kriteria->nama_kriteria,
                'type_kriteria'=>$kriteria->type_kriteria,
                'nilai_kriteria'=>$kriteria->nilai_kriteria
            );
            return response()->json($response);
        }
    }
    public function data(){
        $data = DB::table('tbl_kriteria')->get();
        return DataTables::of($data)->make(true);
    }
}
