<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GenerateCodeAuto extends Controller
{
    private static $prefix;
    private static $code;
    public static function generateCode($prefix, $model, $field)
    {
        self::$prefix = $prefix;
        self::$code = $prefix . mt_rand('1000', '9999');
        while ($model::where($field, self::$code)->exists()) {
            self::$code = $prefix . mt_rand('1000', '9999');
        }
        return self::$code;
    }
    public static function generateCodeTransaction()
    {
        $tanggal = Carbon::now()->format('ymd');
        $lastCode = BarangMasuk::orderByDesc('kd_barang_masuk')->first();
        $noUrut = 1;
        if ($lastCode) {
            $noUrut = intval(substr($lastCode->kd_barang_masuk, -4)) + 1;
        }
        self::$code = 'TR-' . $tanggal . str_pad($noUrut, 4, '0', STR_PAD_LEFT);

        return self::$code;
    }
}
