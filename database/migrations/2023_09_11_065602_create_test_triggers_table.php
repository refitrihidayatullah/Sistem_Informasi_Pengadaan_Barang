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
        // insert data ke tr_barang_masuk saat create data barang masuk
        DB::unprepared('
            CREATE TRIGGER test_trigger AFTER INSERT ON barang_masuks
            FOR EACH ROW
            BEGIN
                INSERT INTO tr_barang_masuks
                (`id`,`supplier_id`,`user_id`,`barang_id`,`stock`,`harga_beli`,`created_at`,`updated_at`) VALUES (NEW.buy_id,NEW.supplier_id,
                NEW.user_id,NEW.barang_id,NEW.stock,NEW.harga_beli,now(),now());
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
        DB::unprepared('DROP TRIGGER IF EXISTS test_trigger');
    }
};
