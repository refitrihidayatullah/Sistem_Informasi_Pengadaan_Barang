<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'barang_keluars';
    protected $primaryKey = 'kd_barang_keluar';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;

    // insert
    public static function insertBarangKeluar(array $data = [])
    {
        return static::create($data);
    }



    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
