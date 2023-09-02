<?php

namespace App\Http\Controllers;

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
}
