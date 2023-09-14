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
        Schema::create('tr_barang_keluars', function (Blueprint $table) {
            $table->id('id');
            $table->string('kd_transaksi');
            $table->string('nama_pelanggan', 20);
            $table->dateTimeTz('tanggal_keluar');
            $table->string('user_id');
            $table->string('barang_id', 8);
            $table->float('stock');
            $table->float('harga_jual');
            $table->float('harga_beli');
            $table->float('diskon');
            $table->float('grandtotal')->nullable();
            $table->float('pembayaran')->nullable();
            $table->float('kembalian')->nullable();
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
        Schema::dropIfExists('tr_barang_keluars');
    }
};
