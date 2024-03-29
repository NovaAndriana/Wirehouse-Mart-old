<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('stok');
            $table->string('satuan');
            $table->string('category');
            $table->string('brand');
            $table->string('supplier');
            $table->string('harga_beli');
            $table->string('harga_jual');
            $table->string('diskon');
            $table->string('deskripsi');
            //$table->Integer('category_id')->unsigned();
            $table->string('image');
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
        Schema::dropIfExists('produks');
    }
}
