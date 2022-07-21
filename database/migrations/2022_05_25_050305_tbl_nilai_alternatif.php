<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblNilaiAlternatif extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nilai_alternatif', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users')->unsigned();
            $table->unsignedBigInteger('volume_belanja')->unsigned();
            $table->unsignedBigInteger('total_belanja')->unsigned();
            $table->unsignedBigInteger('ekspedisi')->unsigned();
            $table->unsignedBigInteger('rating')->unsigned();
            $table->date('date');
            $table->foreign('id_users')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->foreign('volume_belanja')->references('id')->on('tbl_subkriteria')->onDelete('cascade');
            $table->foreign('total_belanja')->references('id')->on('tbl_subkriteria')->onDelete('cascade');
            $table->foreign('ekspedisi')->references('id')->on('tbl_subkriteria')->onDelete('cascade');
            $table->foreign('rating')->references('id')->on('tbl_subkriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_nilai_alternatif');
    }
}
