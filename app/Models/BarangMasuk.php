<?php

namespace App\Models;

use App\Http\Controllers\GenerateCodeAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'barang_masuks';
    protected $primaryKey = 'kd_barang_masuk';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;


    public static function insertBarangMasuk(array $data = [])
    {
        $data['kd_barang_masuk'] = GenerateCodeAuto::generateCodeTransaction();
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
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
