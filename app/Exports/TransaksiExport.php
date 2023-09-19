<?php

namespace App\Exports;

use App\Models\TrBarangKeluar;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return TrBarangKeluar::all();
        $data = DB::table('tr_barang_keluars')->join('users', 'tr_barang_keluars.user_id', '=', 'users.id')
            ->join('barangs', 'tr_barang_keluars.barang_id', '=', 'barangs.kd_barang')
            ->select(
                'tr_barang_keluars.kd_transaksi',
                'tr_barang_keluars.nama_pelanggan',
                'tr_barang_keluars.tanggal_keluar',
                'users.name',
                'barangs.nama_barang',
                'tr_barang_keluars.stock',
                'tr_barang_keluars.harga_jual',
                'tr_barang_keluars.harga_beli',
                'tr_barang_keluars.diskon',
                'tr_barang_keluars.grandtotal',
                'tr_barang_keluars.pembayaran',
                'tr_barang_keluars.kembalian'
            )
            ->get();
        return $data;
    }
    public function headings(): array
    {
        return [
            'kode barang keluar',
            'nama pelanggan',
            'tanggal transaksi',
            'user',
            'nama_barang',
            'stock',
            'harga jual',
            'harga beli',
            'diskon',
            'grandtotal',
            'pembayaran',
            'kembalian',
        ];
    }
}
