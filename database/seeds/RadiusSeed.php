<?php

use Illuminate\Database\Seeder;

class RadiusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_kota_radius')->delete();
        DB::table('tbl_kota_radius')->insert(array(
            array('nama_kota'=>'Balikpapan','jumlah_penduduk'=>616),
            array('nama_kota'=>'Samarinda','jumlah_penduduk'=>813),
            array('nama_kota'=>'Paser','jumlah_penduduk'=>262),
            array('nama_kota'=>'Penajam Paser Utara','jumlah_penduduk'=>154),
            array('nama_kota'=>'Kutai Barat','jumlah_penduduk'=>146),
            array('nama_kota'=>'Kutai Kartanegara','jumlah_penduduk'=>718),
            array('nama_kota'=>'Kutai Timur','jumlah_penduduk'=>320),
            array('nama_kota'=>'Berau','jumlah_penduduk'=>209),
            array('nama_kota'=>'Bontang','jumlah_penduduk'=>163),
            array('nama_kota'=>'Tarakan','jumlah_penduduk'=>236),
            array('nama_kota'=>'Mahakam Ulu','jumlah_penduduk'=>260)
        ));
    }
}
