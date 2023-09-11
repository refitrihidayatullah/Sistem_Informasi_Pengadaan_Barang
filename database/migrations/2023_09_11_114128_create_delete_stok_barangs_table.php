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
        // trigger saat delete barang masuk maka stok barang berkurang
        DB::unprepared('
    CREATE TRIGGER delete_barang_stok AFTER DELETE ON barang_masuks
    FOR EACH ROW
    BEGIN
        UPDATE barangs
        SET stock = stock - old.stock
        WHERE kd_barang = old.barang_id;
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
        Schema::dropIfExists('delete_stok_barangs');
    }
};
