<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->string('id_member');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('password');
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable()    ;
            $table->string('kabupaten')->nullable();
            $table->string('provinsi')->nullable();
            $table->integer('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users');
    }
}
