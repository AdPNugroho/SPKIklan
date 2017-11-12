<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoryWp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tbl_history_wp');
        Schema::create('tbl_history_wp', function (Blueprint $table) {
            $table->increments('id_history_wp');
            $table->integer('id_history')->unsigned();
            $table->string('nama_alternatif',100);
            $table->double('nilai_preferensi');
            $table->timestamps();
            $table->foreign('id_history')->references('id_history')->on('tbl_history')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_history_wp');
    }
}
