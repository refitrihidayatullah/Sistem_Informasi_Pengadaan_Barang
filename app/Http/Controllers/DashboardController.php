<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\TrBarangKeluar;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard_admin()
    {
        $supplier = Supplier::count();
        $barang = Barang::count();
        $barang_masuk = BarangMasuk::count();
        $barang_keluar = TrBarangKeluar::distinct('tanggal_keluar')
            ->OrderByDesc('tanggal_keluar')->count();

        $hitung_stock_masuk = BarangMasuk::groupBy('barang_id')
            ->select('barang_id', DB::raw('SUM(stock) as total_stock'))
            ->get();

        $hitung_stock_tersedia = Barang::orderByDesc('updated_at')->select('kd_barang', 'nama_barang', 'stock')->get();


        return view(
            'dashboard_admin',
            [
                'supplier' => $supplier,
                'barang' => $barang,
                'barang_masuk' => $barang_masuk,
                'barang_keluar' => $barang_keluar,
                'hitung_stock_masuk' => $hitung_stock_masuk,
                'hitung_stock_tersedia' => $hitung_stock_tersedia,
            ]
        );
    }
}
