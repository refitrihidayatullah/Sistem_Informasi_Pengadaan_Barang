<?php

namespace App\Exports;

use App\Models\TrBarangMasuk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangMasukExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return TrBarangMasuk::all();
        $data = DB::table('tr_barang_masuks')->join('suppliers', 'tr_barang_masuks.supplier_id', '=', 'suppliers.kd_supplier')
            ->join('users', 'tr_barang_masuks.user_id', '=', 'users.id')
            ->join('barangs', 'tr_barang_masuks.barang_id', '=', 'barangs.kd_barang')
            ->select(
                'tr_barang_masuks.id',
                'suppliers.nama_supplier',
                'users.name',
                'barangs.nama_barang',
                'tr_barang_masuks.stock',
                'tr_barang_masuks.harga_beli',
                'tr_barang_masuks.created_at',
                'tr_barang_masuks.updated_at',
            )
            ->get();
        return $data;
    }
    public function headings(): array
    {
        return [
            'kode barang masuk',
            'supplier',
            'user',
            'nama barang',
            'stock',
            'harga beli',
            'created at',
            'updated at',
        ];
    }
}
