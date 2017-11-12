<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKotaRadius extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_kota_radius');
        Schema::create('tbl_kota_radius', function (Blueprint $table) {
            $table->increments('id_kota_radius');
            $table->string('nama_kota',80);
            $table->bigInteger('jumlah_penduduk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_kota_radius');
    }
}
