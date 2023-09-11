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
        // trigger saat add barang maka stok barang dan harga berubah
        DB::unprepared('
    CREATE TRIGGER tr_update_barang_stok AFTER INSERT ON barang_masuks
    FOR EACH ROW
    BEGIN
        UPDATE barangs
        SET stock = stock + NEW.stock,
            harga_beli = NEW.harga_beli,
            harga_jual = NEW.harga_jual
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
        DB::unprepared('DROP TRIGGER IF EXISTS tr_update_barang_stok');
    }
};
