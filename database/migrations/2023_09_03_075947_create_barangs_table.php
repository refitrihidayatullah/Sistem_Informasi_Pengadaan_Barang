<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->string('kd_barang', 8)->primary();
            $table->string('nama_barang', 20);
            $table->float('stock')->default(0);
            $table->float('harga_beli')->default(0);
            $table->float('harga_jual')->default(0);
            $table->string('kategori_id', 8);
            $table->string('satuan_id', 8);
            $table->timestamps();
            $table->foreign('kategori_id')->references('kd_kategori')->on('kategoris');
            $table->foreign('satuan_id')->references('kd_satuan')->on('satuans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
