<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\GenerateCodeAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'suppliers';
    protected $primaryKey = 'kd_supplier';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;

    // get all data
    public static function getAllSupplier()
    {
        return static::orderByDesc('updated_at')->get();
    }
    // get data by id
    public static function getByIdSupplier($id)
    {
        return static::where('kd_supplier', $id)->first();
    }

    // insert data
    public static function insertSupplier(array $data = [])
    {
        $data['kd_supplier'] = GenerateCodeAuto::generateCode('SUP-', Supplier::class, 'kd_supplier');
        // cek untuk menghapus tag html dari nilai string
        $data = array_map(function ($value) {
            return is_string($value) ? strip_tags($value) : $value;
        }, $data);
        return static::create($data);
    }

    // update data
    public static function updateSupplier($data, $id)
    {
        $data = array_map(function ($value) {
            return is_string($value) ? strip_tags($value) : $value;
        }, $data);
        return static::where('kd_supplier', $id)->update($data);
    }

    // delete data
    public static function deleteSupplier($id)
    {
        return static::where('kd_supplier', $id)->delete();
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }

    // relasi
    public function barangmasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
