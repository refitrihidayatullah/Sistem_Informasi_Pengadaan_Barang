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
        Schema::create('tr_barang_masuks', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('supplier_id', 8);
            $table->string('user_id');
            $table->string('barang_id', 8);
            $table->float('stock');
            $table->float('harga_beli');
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
        Schema::dropIfExists('tr_barang_masuks');
    }
};
