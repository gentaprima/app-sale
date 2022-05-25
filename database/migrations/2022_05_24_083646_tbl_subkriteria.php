<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblSubkriteria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_subkriteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kriteria')->unsigned();
            $table->string('description');
            $table->integer('jumlah')->nullable();
            $table->integer('nilai_bobot');
            $table->foreign('id_kriteria')->references('id')->on('tbl_kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_subkriteria');
    }
}
