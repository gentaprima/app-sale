<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblPemenang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pemenang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users')->unsigned();
            $table->integer('tahun');
            $table->integer('bulan');
            $table->foreign('id_users')->references('id')->on('tbl_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pemenang');
    }
}
