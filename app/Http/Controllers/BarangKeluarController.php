<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\TrBarangKeluar;
use App\Validators\ValidatorRules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_barang = Barang::where('stock', '>', 0)->where('harga_jual', '>', 0)->orderByDesc('updated_at')->get();
        $kd_transaction = GenerateCodeAuto::generateCodeTransaction('TRK-', BarangKeluar::class, 'kd_barang_keluar');
        $barang_keluar = BarangKeluar::with('barang')->where('transaksi_id', null)->orderByDesc('updated_at')->get();

        return view(
            'barang_keluar.index_barang_keluar',
            [
                'data_barang' => $data_barang,
                'kd_transaction' => $kd_transaction,
                'barang_keluar' => $barang_keluar,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = ValidatorRules::addBarangKeluarRules($request->all());
        if ($validator->fails()) {
            return redirect('/barang-keluar')->withErrors($validator)->withInput();
        }
        try {


            $barang_values = explode(',', $request->barang_id);
            $kd_barang = $barang_values[0];
            $harga_beli = $barang_values[1];
            $harga_jual = $barang_values[2];
            $data = [
                'kd_barang_keluar' => GenerateCodeAuto::generateCodeTransaction('TRK-', BarangKeluar::class, 'kd_barang_keluar'),
                'nama_pelanggan' => $request->nama_pelanggan,
                'tanggal_keluar' => $request->tgl_transaksi,
                'user_id' => Auth::user()->id ?: 'user',
                'barang_id' => $kd_barang,
                'jumlah_keluar' => $request->jumlah_barang,
                'harga_jual' => $harga_jual,
                'harga_beli' => $harga_beli,
                'diskon' => $request->diskon_barang
            ];
            Session(['nama_pelanggan' => $request->nama_pelanggan, 'tgl_transaksi' => $request->tgl_transaksi]);
            // session()->forget(['nama_pelanggan','tgl_transaksi']);

            if (BarangKeluar::where('tanggal_keluar', $request->tgl_transaksi)->where('barang_id', $kd_barang)->exists()) {
                $stock = BarangKeluar::where('tanggal_keluar', $request->tgl_transaksi)->where('barang_id', $kd_barang)->select('jumlah_keluar', 'diskon')->first();
                $stockNew = $stock->jumlah_keluar + $request->jumlah_barang;
                if ($stock->diskon > $request->diskon_barang) {
                    $diskonNew =  $request->diskon_barang;
                } else {
                    $diskonNew =  $stock->diskon + $request->diskon_barang;
                }
                BarangKeluar::where('tanggal_keluar', $request->tgl_transaksi)->where('barang_id', $kd_barang)->update(['jumlah_keluar' => $stockNew, 'diskon' => $diskonNew]);
            } else {
                BarangKeluar::insertBarangKeluar($data);
            }
            return redirect('/barang-keluar')->with('success', 'Berhasil Ditambahkan')->withInput();
        } catch (\Exception $e) {
            return redirect('/barang-keluar')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function insertTrBarang(Request $request, $id)
    {
        try {
            DB::beginTransaction();



            if ($request->tgl_transaksi == decrypt($id)) {

                $datacode =  $request->tgl_transaksi;
                $arrdatacode = explode(" ", $datacode);
                $time = str_replace(":", "", $arrdatacode[1]);
                $tglcode = explode("-", $arrdatacode[0]);
                $tgl = $tglcode[2];
                $transaksi_code = "Transaction-" . $tgl . $time;

                $data_barang_keluar = BarangKeluar::where('tanggal_keluar', decrypt($id))->where('nama_pelanggan', $request->nama_pelanggan)->get();
                $tr_barang_keluar = [];

                foreach ($data_barang_keluar as $barang_keluar) {
                    $stok_barang = Barang::where('kd_barang', $barang_keluar->barang_id)->value('stock');
                    if ($stok_barang >= $barang_keluar->jumlah_keluar) {
                        $tr_barang_keluar[] =
                            [
                                'kd_transaksi' =>  $transaksi_code,
                                'nama_pelanggan' => $barang_keluar->nama_pelanggan ?: $request->nama_pelanggan,
                                'tanggal_keluar' => $barang_keluar->tanggal_keluar ? $barang_keluar->tanggal_keluar : $request->tgl_transaksi,
                                'user_id' => $barang_keluar->user_id,
                                'barang_id' => $barang_keluar->barang_id,
                                'stock' => $barang_keluar->jumlah_keluar,
                                'harga_jual' => $barang_keluar->harga_jual,
                                'harga_beli' => $barang_keluar->harga_beli,
                                'diskon' => $barang_keluar->diskon,
                                'grandtotal' => $request->grandtotal,
                                'pembayaran' => $request->pembayaran,
                                'kembalian' => $request->pembayaran > $request->grandtotal ? $request->pembayaran - $request->grandtotal : 0,
                            ];
                    } else {
                        return redirect('/barang-keluar')->with('failed', 'Stock Tidak Cukup');
                    }
                }





                if ($transaksi_code) {

                    for ($a = 0; $a < count($tr_barang_keluar); $a++) {
                        TrBarangKeluar::insert($tr_barang_keluar[$a]);
                    }

                    $update_barang_keluar = ['transaksi_id' => $transaksi_code];

                    BarangKeluar::where('tanggal_keluar', $request->tgl_transaksi)->where('nama_pelanggan', $request->nama_pelanggan)->select('transaksi_id')->update($update_barang_keluar);


                    session()->forget(['nama_pelanggan', 'tgl_transaksi']);
                    DB::commit();
                    return redirect('/riwayat-transaksi')->with('success', 'Transaksi Berhasil Silahkan Cetak Nota');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/barang-keluar')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $count = BarangKeluar::where('tanggal_keluar', $request->tanggal_keluar)->where('transaksi_id', null)->count();
            if ($count ==  1) {
                BarangKeluar::where('kd_barang_keluar', decrypt($id))->delete();
                session()->forget(['nama_pelanggan', 'tgl_transaksi']);
            } else {
                BarangKeluar::where('kd_barang_keluar', decrypt($id))->delete();
            }
            return redirect('/barang-keluar')->with('success', 'data berhasi didelete');
        } catch (\Exception $e) {
            return redirect('/barang-keluar')->with('failed', 'Terjadi Kesalahan');
        }
    }
    public function reset($id)
    {
        try {
            BarangKeluar::where('tanggal_keluar', decrypt($id))->where('transaksi_id', null)->delete();
            session()->forget(['nama_pelanggan', 'tgl_transaksi']);
            return redirect('/barang-keluar')->with('success', 'data berhasi direset');
        } catch (\Exception $e) {
            return redirect('/barang-keluar')->with('failed', 'Terjadi Kesalahan');
        }
    }
}
