<?php

namespace App\Models;

use App\Http\Controllers\GenerateCodeAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'barangs';
    protected $primaryKey = 'kd_barang';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;

    // insert data
    public static function insertBarang(array $data = [])
    {
        $data['kd_barang'] = GenerateCodeAuto::generateCode('BRG-', Barang::class, 'kd_barang');
        return static::create($data);
    }
    // update data
    public static function updateBarang(array $data = [], $id)
    {
        return static::where('kd_barang', $id)->update($data);
    }
    // delete
    public static function deleteBarang($id)
    {
        return static::where('kd_barang', $id)->delete();
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
    // relasi
    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }
    // relasi
    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
