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
        // membuat id otomatis sebelum insert data barang masuk
        DB::unprepared('
                CREATE TRIGGER barang_masuks_before_insert
                BEFORE INSERT ON barang_masuks
                FOR EACH ROW
                BEGIN
                    SET NEW.buy_id = CONCAT("TRM-", UNIX_TIMESTAMP(NOW()), "-", FLOOR(RAND() * 100000));
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
        DB::unprepared('DROP TRIGGER IF EXISTS barang_masuks_before_insert');
    }
};
