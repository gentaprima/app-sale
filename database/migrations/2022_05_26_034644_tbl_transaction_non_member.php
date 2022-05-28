<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTransactionNonMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_transaction_non_member', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('alamat');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->integer('qty');
            $table->integer('total');
            $table->integer('subtotal');
            $table->date('date');
            $table->unsignedBigInteger('id_product')->unsigned();
            $table->unsignedBigInteger('id_expedition')->unsigned();
            $table->foreign('id_product')->references('id')->on('tbl_product')->onDelete('cascade');
            $table->foreign('id_expedition')->references('id')->on('tbl_subkriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidK
     */
    public function down()
    {
        Schema::dropIfExists('tbl_transaction_non_member');
    }
}
