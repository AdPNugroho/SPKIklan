<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_kriteria');
        Schema::create('tbl_kriteria', function (Blueprint $table) {
            $table->increments('id_kriteria');
            $table->string('nama_kriteria',50);
            $table->enum('type_kriteria',['benefit','cost']);
            $table->integer('nilai_kriteria');
            $table->double('nilai_bobot')->nullable();
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
        Schema::dropIfExists('tbl_kriteria');
    }
}
