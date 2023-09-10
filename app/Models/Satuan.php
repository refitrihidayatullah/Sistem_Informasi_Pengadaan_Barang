<?php

namespace App\Models;

use App\Http\Controllers\GenerateCodeAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'satuans';
    protected $primaryKey = 'kd_satuan';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;

    //get all data
    public static function getAllSatuan()
    {
        return static::orderByDesc('updated_at')->get();
    }
    // get by id
    public static function getByIdSatuan($id)
    {
        return static::where('kd_satuan', $id)->first();
    }
    //insert data
    public static function insertSatuan(array $data = [])
    {
        $data['kd_satuan'] = GenerateCodeAuto::generateCode('STN-', Satuan::class, 'kd_satuan');
        $data = array_map(function ($value) {
            return is_string($value) ? strip_tags($value) : $value;
        }, $data);
        return static::create($data);
    }
    // update data
    public static function updateSatuan(array $data = [], $id)
    {
        $data = array_map(function ($value) {
            return is_string($value) ? strip_tags($value) : $value;
        }, $data);
        return static::where('kd_satuan', $id)->update($data);
    }
    // delete
    public static function deleteSatuan($id)
    {
        return static::where('kd_satuan', $id)->delete();
    }
    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }
    // relasi
    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
