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

        DB::unprepared('
        CREATE TRIGGER update_stock_tr_barang_keluar AFTER INSERT ON tr_barang_keluars
        FOR EACH ROW
        BEGIN
        UPDATE barangs
        SET stock = stock - NEW.stock
        WHERE kd_barang = NEW.barang_id;

    END
    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_stock_tr_barang_keluar');
    }
};
