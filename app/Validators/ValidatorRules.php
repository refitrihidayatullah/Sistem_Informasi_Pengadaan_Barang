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
    public static function satuanRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'nama_satuan' => 'required|regex:/^[a-zA-Z\s]+$/',
            ],
            [
                'nama_satuan.required' => 'nama satuan harus diisi',
                'nama_satuan.regex' => 'nama satuan tidak boleh mengandung angka/simbol',
            ]
        );
    }
    public static function barangRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'nama_barang' => 'required',
                'kategori_id' => 'required',
                'satuan_id' => 'required',
            ],
            [
                'nama_barang.required' => 'nama barang harus diisi',
                'kategori_id.required' => 'kategori barang harus diisi',
                'satuan_id.required' => 'satuan barang harus diisi',
            ]
        );
    }
    public static function registerRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'name' => 'required',
                'username' => 'required|unique:Users,username',
                'no_telp' => 'required|numeric|not_in:-0|regex:/^\+?\d{10,15}$/',
                'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+{}\[\]:;<>,.?~\\-])/',
                'password_confirm' => 'required|same:password',
                'role' => 'required',
            ],
            [
                'name.required' => 'name harus diisi',
                'username.required' => 'username harus diisi',
                'username.unique' => 'username sudah terdaftar',
                'no_telp.required' => 'no telp harus diisi',
                'no_telp.not_in' => 'no telp tidak boleh negatif',
                'no_telp.numeric' => 'no telp harus angka',
                'no_telp.regex' => 'no telp tidak valid',
                'password.required' => 'password harus diisi',
                'password.min' => 'password minimal 8 karakter',
                'password.regex' => 'password harus mengandung huruf kapital, angka dan simbol',
                'password_confirm.required' => 'password confirm harus diisi',
                'password_confirm.same' => 'password tidak sama',
                'role.required' => 'role harus diisi',
            ]
        );
    }
    public static function loginRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'username harus diisi',
                'password.required' => 'password harus diisi',
            ]
        );
    }
    public static function barangMasukRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'kd_barang' => 'required',
                'kd_supplier' => 'required',
                'harga_beli' => 'required|numeric|not_in:-0|min:0',
                'harga_jual' => 'required|numeric|not_in:-0|min:0',
                'jumlah_masuk' => 'required|numeric|not_in:-0|min:0',

            ],
            [
                'kd_barang.required' => 'nama barang harus diisi',
                'kd_supplier.required' => 'nama supplier harus diisi',
                'harga_beli.required' => 'harga beli harus diisi',
                'harga_beli.numeric' => 'harga beli harus angka',
                'harga_beli.not_in' => 'harga beli tidak boleh negatif',
                'harga_beli.min' => 'harga beli minimal 0',
                'harga_jual.required' => 'harga jual harus diisi',
                'harga_jual.numeric' => 'harga jual harus angka',
                'harga_jual.not_in' => 'harga jual tidak boleh negatif',
                'harga_jual.min' => 'harga jual minimal 0',
                'jumlah_masuk.required' => 'jumlah barang harus diisi',
                'jumlah_masuk.numeric' => 'jumlah barang harus angka',
                'jumlah_masuk.not_in' => 'jumlah barang tidak boleh negatif',
                'jumlah_masuk.min' => 'jumlah barang minimal 0',
            ]
        );
    }
    public static function addBarangKeluarRules(array $data = [])
    {
        return Validator::make(
            $data,
            [
                'nama_pelanggan' => 'required|regex:/^[a-zA-Z\s]+$/',
                'barang_id' => 'required',
                'jumlah_barang' => 'required|numeric|not_in:-0|min:0',
                'diskon_barang' => 'numeric|min:0|max:100'
            ],
            [
                'nama_pelanggan.required' => 'nama pelanggan harus diisi',
                'nama_pelanggan.regex' => 'nama pelanggan tidak boleh mengandung angka atau simbol',
                'barang_id.required' => 'nama barang harus diisi',
                'jumlah_barang.required' => 'jumlah barang harus diisi',
                'jumlah_barang.numerik' => 'jumlah barang harus angka',
                'jumlah_barang.not_in' => 'jumlah barang tidak boleh angka negatif',
                'jumlah_barang.min' => 'jumlah barang minimal 1',
                'diskon_barang.numeric' => 'diskon barang harus angka',
                'diskon_barang.min' => 'diskon barang minimal 0',
                'diskon_barang.max' => 'diskon barang maximal 100',

            ]
        );
    }
}
