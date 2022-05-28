<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblTransactionMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_transaction_member', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->unsignedBigInteger('id_users')->unsigned();
            $table->unsignedBigInteger('id_product')->unsigned();
            $table->unsignedBigInteger('id_expedition')->unsigned();
            $table->integer('qty');
            $table->integer('total');
            $table->integer('subtotal');
            $table->integer('discount');
            $table->date('date');
            $table->foreign('id_users')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('tbl_product')->onDelete('cascade');
            $table->foreign('id_expedition')->references('id')->on('tbl_subkriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_transaction_member');
    }
}
