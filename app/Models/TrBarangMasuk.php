<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrBarangMasuk extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'tr_barang_masuks';
    protected $primaryKey = 'id';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;
}
