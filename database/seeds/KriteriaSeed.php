<?php

use Illuminate\Database\Seeder;
class KriteriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_kriteria')->delete();
        DB::table('tbl_kriteria')->insert(array(
            array('nama_kriteria'=>'Oplah Penjualan','type_kriteria'=>'benefit','nilai_kriteria'=>'1','nilai_bobot'=>'0.25'),
            array('nama_kriteria'=>'Radius Penyebaran','type_kriteria'=>'benefit','nilai_kriteria'=>'1','nilai_bobot'=>'0.25'),
            array('nama_kriteria'=>'Jumlah Halaman','type_kriteria'=>'benefit','nilai_kriteria'=>'1','nilai_bobot'=>'0.25'),
            array('nama_kriteria'=>'Harga Iklan','type_kriteria'=>'cost','nilai_kriteria'=>'1','nilai_bobot'=>'0.25'),
        )); 
    }
}
