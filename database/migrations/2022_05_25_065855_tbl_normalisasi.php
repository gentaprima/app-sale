<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblNormalisasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_normalisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nilai_alternatif')->unsigned();
            $table->double('n_volume_belanja');
            $table->double('n_total_belanja');
            $table->double('n_total');
            $table->date('date');
            $table->foreign('id_nilai_alternatif')->references('id')->on('tbl_nilai_alternatif')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_normalisasi');
    }
}
