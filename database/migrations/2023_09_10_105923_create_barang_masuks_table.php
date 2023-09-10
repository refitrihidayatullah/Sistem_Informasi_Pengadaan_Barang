<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->string('kd_barang_masuk')->primary();
            $table->string('supplier_id', 8);
            $table->string('user_id');
            $table->string('barang_id', 8);
            $table->float('stock');
            $table->float('harga_beli');
            $table->float('harga_jual');
            $table->date('tanggal_masuk');
            $table->timestamps();
            $table->foreign('supplier_id')->references('kd_supplier')->on('suppliers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('barang_id')->references('kd_barang')->on('barangs');
        });

        DB::unprepared('
    CREATE TRIGGER tr_update_barang_stok AFTER INSERT ON barang_masuks
    FOR EACH ROW
    BEGIN
        UPDATE barangs
        SET stock = stock + NEW.stock,
            harga_beli = harga_beli + NEW.harga_beli,
            harga_jual = harga_jual + NEW.harga_jual
        WHERE kd_barang = NEW.barang_id;
    END;
');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_masuks');
    }
};
