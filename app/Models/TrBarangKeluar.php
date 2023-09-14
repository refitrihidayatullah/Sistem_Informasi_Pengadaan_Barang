<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrBarangKeluar extends Model
{
    use HasFactory, HasUuids;
    // protected $guarded = [''];
    protected $fillable = ['kd_transaksi', 'nama_pelanggan', 'tanggal_keluar', 'user_id', 'barang_id', 'stock', 'harga_jual', 'harga_beli', 'diskon', 'grandtotal', 'pembayaran', 'kembalian'];
    public $timestamps = true;
    protected $table = 'tr_barang_keluars';
    // protected $primaryKey = 'id';
    // increment diperlukan jika id menggunakan varchar/uuid
    public $incrementing = false;
}
