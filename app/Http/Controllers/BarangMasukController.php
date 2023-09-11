<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Validators\ValidatorRules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_barang_masuk = BarangMasuk::with('barang', 'user', 'supplier')->orderByDesc('updated_at')->get();
        return view(
            'barang_masuk.index_barang_masuk',
            [
                'data_barang_masuk' => $data_barang_masuk,
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
        $data_barang = Barang::with('kategori')->orderByDesc('updated_at')->get();
        $data_supplier = Supplier::getAllSupplier();
        return view(
            'barang_masuk.create_barang_masuk',
            [
                'data_barang' => $data_barang,
                'data_supplier' => $data_supplier,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = ValidatorRules::barangMasukRules($request->all());
        if ($validator->fails()) {
            return redirect('/barang-masuk/create')->withErrors($validator)->withInput();
        }
        try {
            $data = $request->all();
            $data['harga_beli'] = str_replace(".", "", $request->harga_beli) ?: $request->harga_beli;
            $data['harga_jual'] = str_replace(".", "", $request->harga_jual) ?: $request->harga_jual;
            $data['barang_id'] = $request->kd_barang;
            $data['supplier_id'] = $request->kd_supplier;
            $data['stock'] = $request->jumlah_masuk;
            $data['user_id'] = Auth::user()->id;
            BarangMasuk::insertBarangMasuk($data);
            return redirect('/barang-masuk')->with('success', 'data transaksi barang berhasil');
        } catch (\Exception $e) {
            return redirect('/barang-masuk')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $buy_id = decrypt($id);
            DB::table('barang_masuks')->where('buy_id', $buy_id)->delete();
            DB::table('tr_barang_masuks')->where('id', $buy_id)->delete();
            DB::commit();
            return redirect('/barang-masuk')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/barang-masuk')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
}
