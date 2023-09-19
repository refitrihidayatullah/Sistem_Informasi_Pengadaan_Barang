<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use App\Models\TrBarangKeluar;
use App\Exports\BarangMasukExport;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function laporan_barang_masuk(Request $request)
    {
        $key = $request->keylaporanbarangmasuk;
        if (strlen($key)) {
            $data_barang_masuk = BarangMasuk::where('kd_barang_masuk', 'like', "%$key%")
                ->orWhere('stock', 'like', "%$key%")
                ->orWhere('harga_beli', 'like', "%$key%")
                ->orWhere('harga_jual', 'like', "%$key%")
                ->orWhere('tanggal_masuk', 'like', "%$key%")
                ->paginate();
        } else {
            $data_barang_masuk = BarangMasuk::with('barang', 'user', 'supplier')->orderByDesc('updated_at')->paginate(5);
        }
        return view(
            'laporan.laporan_barang_masuk',
            [
                'data_barang_masuk' => $data_barang_masuk,
            ]

        );
    }
    public function export_barang_masuk()
    {
        return Excel::download(new BarangMasukExport, 'barang_masuk.xlsx');
    }
    public function laporan_barang_keluar(Request $request)
    {
        $key = $request->keylaporanbarangkeluar;
        if (strlen($key)) {
            $data_barang_keluar = TrBarangKeluar::where('kd_transaksi', 'like', "%$key%")
                ->orWhere('nama_pelanggan', 'like', "%$key%")
                ->orWhere('tanggal_keluar', 'like', "%$key%")
                ->paginate();
        } else {
            $data_barang_keluar = TrBarangKeluar::select('kd_transaksi', 'nama_pelanggan', 'tanggal_keluar', 'user_id', 'grandtotal')->distinct('tanggal_keluar')
                ->OrderByDesc('tanggal_keluar')->paginate(5);
        }
        $user_kasir = User::all();
        return view(
            'laporan.laporan_barang_keluar',
            [
                'data_barang_keluar' => $data_barang_keluar,
                'user_kasir' => $user_kasir,
            ]

        );
    }
    public function export_barang_keluar()
    {
        return Excel::download(new TransaksiExport, 'barang_keluar.xlsx');
    }
}
