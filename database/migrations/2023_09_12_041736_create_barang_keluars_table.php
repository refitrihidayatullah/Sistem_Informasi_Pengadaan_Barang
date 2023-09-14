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
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->string('kd_barang_keluar')->primary();
            $table->string('transaksi_id')->nullable();
            $table->string('nama_pelanggan', 20);
            $table->dateTimeTz('tanggal_keluar');
            $table->string('user_id');
            $table->string('barang_id', 8);
            $table->float('jumlah_keluar');
            $table->float('harga_jual');
            $table->float('harga_beli');
            $table->float('diskon');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('barang_id')->references('kd_barang')->on('barangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_keluars');
    }
};
