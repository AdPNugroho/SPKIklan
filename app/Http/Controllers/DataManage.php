<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DataManage extends Controller
{
    public function saveAlternatif(Request $request){
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
            $this->normalisasiMatriksSAW();
            $this->preferensiSAW();
            $this->preferensiWP();
            return response()->json(array('message'=>'Data Alternatif Berhasil Di Input','status'=>'info','id'=>$id));
        }
    }
    public function deleteAlternatif(Request $request){
        if($request->ajax()){
            DB::table('tbl_alternatif')->where('id_alternatif', '=',$request->id_alternatif)->delete();
            $this->normalisasiMatriksSAW();
            $this->preferensiSAW();
            $this->preferensiWP();
            return response()->json(array('message'=>'Alternatif Berhasil Di Hapus','status'=>'error'));
        }
    }
    public function updateKriteria(Request $request){
        if($request->ajax()){
            $data = array(
                'nilai_kriteria'=>$request->nilai_kriteria
            );
            DB::table('tbl_kriteria')->where('id_kriteria',$request->id_kriteria)->update($data);
            $total = DB::table('tbl_kriteria')->sum('nilai_kriteria');
            $dataKriteria = array();
            $k = DB::table('tbl_kriteria')->get();
            foreach($k as $key => $value){
                $dataKriteria[$key]['id_kriteria'] = $value->id_kriteria;
                $dataKriteria[$key]['nilai_bobot'] = $value->nilai_kriteria/$total;
            }
            foreach($dataKriteria as $key=>$value){
                DB::table('tbl_kriteria')->where('id_kriteria',$value['id_kriteria'])->update($value);
            }
            $this->preferensiSAW();
            $this->preferensiWP();
            $response = array(
                'message'=>'Data Kriteria Sudah Di Ubah',
                'status'=>'info',
                'total'=>$total
            );
            return response()->json($response);
        }
    }
    public function updateEvaluasi(Request $request){
        if($request->ajax()){
            $arrWhere = array();
            $data = $request->all();
            if(isset($data['kota_radius']) && count($data['kota_radius'])>0){
                $total = DB::table('tbl_kota_radius')->whereIn('id_kota_radius',$data['kota_radius'])->sum('jumlah_penduduk');
            }else{
                $total = 0;
            }
            $arrInsert = array(
                array('id_alternatif'=>$data['id_alternatif'],'id_kriteria'=>'1','nilai_evaluasi'=>$data['oplah_harian']),
                array('id_alternatif'=>$data['id_alternatif'],'id_kriteria'=>'2','nilai_evaluasi'=>$total),
                array('id_alternatif'=>$data['id_alternatif'],'id_kriteria'=>'3','nilai_evaluasi'=>$data['jumlah_halaman']),
                array('id_alternatif'=>$data['id_alternatif'],'id_kriteria'=>'4','nilai_evaluasi'=>$data['harga_iklan'])
            );
            DB::table('tbl_evaluasi')->where('id_alternatif',$data['id_alternatif'])->delete();
            DB::table('tbl_evaluasi')->insert($arrInsert);
            $this->normalisasiMatriksSAW();
            $this->preferensiSAW();
            $this->preferensiWP();
            return response()->json(array('message'=>'Data Evaluasi Telah di Update','status'=>'info'));
        }
    }
    public function normalisasiMatriksSAW(){
        $alternatif = DB::table('tbl_alternatif')->get();
        $kriteria = DB::table('tbl_kriteria')->get();
        $arrayInsert = array();
        foreach($kriteria as $rowKriteria){
            if($rowKriteria->type_kriteria=="benefit"){
                $max = DB::table('tbl_evaluasi')->where('id_kriteria',$rowKriteria->id_kriteria)->max('nilai_evaluasi');
                foreach($alternatif as $rowAlternatif){
                    $nilai = DB::table('tbl_evaluasi')->where('id_alternatif',$rowAlternatif->id_alternatif)->where('id_kriteria',$rowKriteria->id_kriteria)->first();
                    $x = array(
                        'id_evaluasi'=>$nilai->id_evaluasi,
                        'nilai_matriks'=>$nilai->nilai_evaluasi/$max
                    );
                    array_push($arrayInsert,$x);
                }
            }else{
                $min = DB::table('tbl_evaluasi')->where('id_kriteria',$rowKriteria->id_kriteria)->min('nilai_evaluasi');
                foreach($alternatif as $rowAlternatif){
                    $nilai = DB::table('tbl_evaluasi')->where('id_alternatif',$rowAlternatif->id_alternatif)->where('id_kriteria',$rowKriteria->id_kriteria)->first();
                    $x = array(
                        'id_evaluasi'=>$nilai->id_evaluasi,
                        'nilai_matriks'=>$min/$nilai->nilai_evaluasi
                    );
                    array_push($arrayInsert,$x);
                }
            }
        }
        DB::table('tbl_matriks_saw')->truncate();
        DB::table('tbl_matriks_saw')->insert($arrayInsert);
    }
    public function preferensiSAW(){
        $alternatif = DB::table('tbl_alternatif')->get();
        $kriteria = DB::table('tbl_kriteria')->get();
        foreach($alternatif as $rowAlternatif){
            $nilaiPreferensi = 0;
            foreach($kriteria as $rowKriteria){
                $nilai = DB::table('tbl_evaluasi')
                                ->join('tbl_matriks_saw','tbl_evaluasi.id_evaluasi','=','tbl_matriks_saw.id_evaluasi')
                                ->where('id_alternatif',$rowAlternatif->id_alternatif)
                                ->where('id_kriteria',$rowKriteria->id_kriteria)
                                ->first();
                $nilaiPreferensi = $nilaiPreferensi + ($nilai->nilai_matriks*$rowKriteria->nilai_bobot);
            }
            DB::table('tbl_vektor_saw')->where('id_alternatif',$rowAlternatif->id_alternatif)->update(array('nilai_vektor_v'=>$nilaiPreferensi));
        }
    }
    public function preferensiWP(){
        $alternatif = DB::table('tbl_alternatif')->get();
        foreach($alternatif as $rowAlternatif=>$value){
            $evaluasi = DB::table('tbl_evaluasi')->join('tbl_kriteria','tbl_evaluasi.id_kriteria','=','tbl_kriteria.id_kriteria')->where('id_alternatif',$value->id_alternatif)->get();
            $s = 1;
            foreach($evaluasi as $rowEvaluasi){
                if($rowEvaluasi->type_kriteria=="benefit"){
                    $s *= pow($rowEvaluasi->nilai_evaluasi,$rowEvaluasi->nilai_bobot);
                }else{
                    $s *= pow($rowEvaluasi->nilai_evaluasi,-$rowEvaluasi->nilai_bobot);
                }
            }
            DB::table('tbl_vektor_wp')->where('id_alternatif',$value->id_alternatif)->update(array('nilai_vektor_s'=>$s));
        }
        $TotalVektor = DB::table('tbl_vektor_wp')->sum('nilai_vektor_s');
        $vektorWP = DB::table('tbl_vektor_wp')->get();
        foreach($vektorWP as $rowVektorWP){
            DB::table('tbl_vektor_wp')->where('id_vektor_wp',$rowVektorWP->id_vektor_wp)->update(array(
                'nilai_vektor_v'=>$rowVektorWP->nilai_vektor_s/$TotalVektor
            ));
        }
    }
    
    
}
