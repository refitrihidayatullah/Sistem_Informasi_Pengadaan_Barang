<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class ValidatorRules
{
    public static function supplierRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'nama_supplier' => 'required',
                'no_telp_supplier' => 'required|numeric|regex:/^[0-9]{10,15}$/',
                'alamat_supplier' => 'required',
            ],
            [
                'nama_supplier.required' => 'nama supplier harus diisi',
                'no_telp_supplier.required' => 'no telp harus diisi',
                'no_telp_supplier.numeric' => 'no telp harus angka',
                'no_telp_supplier.regex' => 'no telp memiliki minimal panjang 10 angka maksimal 15 angka',
                'alamat_supplier.required' => 'alamat harus diisi',
            ]
        );
    }
    public static function kategoriRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'nama_kategori' => 'required',
            ],
            [
                'nama_kategori.required' => 'nama kategori harus diisi',
            ]
        );
    }
}
