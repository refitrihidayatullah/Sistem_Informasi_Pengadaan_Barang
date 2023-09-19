<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TrBarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatTransaksi extends Controller
{
    public function index(Request $request)
    {
        $key = $request->keyriwayattransaksi;
        if (strlen($key)) {
            $transaksi_barang = TrBarangKeluar::where('kd_transaksi', 'like', "%$key%")
                ->orWhere('nama_pelanggan', 'like', "%$key%")
                ->orWhere('tanggal_keluar', 'like', "%$key%")
                ->paginate();
        } else {
            $transaksi_barang = TrBarangKeluar::select('kd_transaksi', 'nama_pelanggan', 'tanggal_keluar', 'user_id', 'grandtotal')->distinct('tanggal_keluar')
                ->OrderByDesc('tanggal_keluar')->paginate(5);
        }
        $user_kasir = User::all();

        return view(
            'riwayat_transaksi.index_riwayat_transaksi',
            [
                'transaksi_barang' => $transaksi_barang,
                'user_kasir' => $user_kasir,
            ]
        );
    }
    public function cetakTransaksi($id)
    {
        $data_transaksi = TrBarangKeluar::where('tanggal_keluar', decrypt($id))->select('kd_transaksi', 'nama_pelanggan', 'tanggal_keluar', 'user_id', 'grandtotal', 'pembayaran', 'kembalian')->distinct('tanggal_keluar')
            ->OrderByDesc('tanggal_keluar')->first();
        $user_kasir = User::all();
        $data_barang = TrBarangKeluar::where('tanggal_keluar', decrypt($id))->select('barang_id', 'stock', 'harga_jual', 'diskon', 'grandtotal', 'pembayaran', 'kembalian')->OrderByDesc('tanggal_keluar')->get();
        $master_barang = Barang::all();

        // return view(
        //     'riwayat_transaksi.invoice',
        //     [
        //         'data_transaksi' => $data_transaksi,
        //         'user_kasir' => $user_kasir,
        //         'data_barang' => $data_barang,
        //         'master_barang' => $master_barang,
        //     ]
        // );
        $file_name = "invoice_" . Carbon::now()->translatedFormat('d_F_y_H_i_s') . ".pdf";
        $pdf = Pdf::loadView('riwayat_transaksi.invoice',  [
            'data_transaksi' => $data_transaksi,
            'user_kasir' => $user_kasir,
            'data_barang' => $data_barang,
            'master_barang' => $master_barang
        ])->setPaper('a4', 'potrate')->setWarnings(false)->save($file_name);
        $response =  $pdf->download($file_name);
        unlink(public_path() . "/" . $file_name);
        return $response;
    }
    public function deleteTransaksi($id)
    {
        try {
            TrBarangKeluar::where('kd_transaksi', decrypt($id))->delete();
            return redirect('/riwayat-transaksi')->with('success', 'Data Transaksi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/riwayat-transaksi')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
}
