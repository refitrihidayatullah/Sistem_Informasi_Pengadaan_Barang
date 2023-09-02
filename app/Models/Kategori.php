<?php

namespace App\Models;

use App\Http\Controllers\GenerateCodeAuto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = [''];
    public $timestamps = true;
    protected $table = 'kategoris';
    protected $primaryKey = 'kd_kategori';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;

    // get all data
    public static function getAllKategori()
    {
        return static::orderByDesc('updated_at')->get();
    }

    // get data by id
    public static function getByIdKategori($id)
    {
        return static::where('kd_kategori', $id)->first();
    }

    // insert data
    public static function insertKategori(array $data = [])
    {
        $data['kd_kategori'] = GenerateCodeAuto::generateCode('KTG-', Kategori::class, 'kd_kategori');
        return static::create($data);
    }

    // update data
    public static function updateKategori(array $data = [], $id)
    {
        return static::where('kd_kategori', $id)->update($data);
    }

    // delete data
    public static function deleteKategori($id)
    {
        return static::where('kd_kategori', $id)->delete();
    }

    public function setAttribute($key, $value)
    {
        parent::setAttribute($key, strtoupper($value));
    }
}
