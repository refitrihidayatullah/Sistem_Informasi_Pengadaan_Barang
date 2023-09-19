<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use App\Validators\ValidatorRules;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->keybarang;
        if (strlen($key)) {
            $data_barang = Barang::with('kategori', 'satuan')->where('kd_barang', 'like', "%$key%")
                ->orWhere('nama_barang', 'like', "%$key%")
                ->orWhere('stock', 'like', "%$key%")
                ->orWhere('harga_beli', 'like', "%$key%")
                ->orWhere('harga_jual', 'like', "%$key%")
                ->paginate();
        } else {
            $data_barang = Barang::with('kategori', 'satuan')->orderByDesc('updated_at')->paginate(5);
        }
        return view(
            'barang.index_barang',
            [
                'data_barang' => $data_barang,
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
        $data_kategori = Kategori::getAllKategori();
        $data_satuan = Satuan::getAllSatuan();
        return view(
            'barang.create_barang',
            [
                'data_kategori' => $data_kategori,
                'data_satuan' => $data_satuan,
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
        $validator = ValidatorRules::barangRules($request->all());
        if ($validator->fails()) {
            return redirect('/barang/create')->withErrors($validator)->withInput();
        }
        try {
            Barang::insertBarang($request->all());
            return redirect('/barang')->with('success', 'data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/barang')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
        $barang = Barang::with('kategori', 'satuan')->where('kd_barang', decrypt($id))->first();
        $data_kategori = Kategori::getAllKategori();
        $data_satuan = Satuan::getAllSatuan();
        return view(
            'barang.edit_barang',
            [
                'barang' => $barang,
                'data_kategori' => $data_kategori,
                'data_satuan' => $data_satuan,

            ]
        );
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
        $validator = ValidatorRules::barangRules($request->all());
        if ($validator->fails()) {
            return redirect("/barang/" . $id . "/edit")->withErrors($validator)->withInput();
        }
        try {
            $data = $request->except('_token', '_method');
            $data['harga_jual'] = str_replace('.', '', $request->harga_jual) ?: $request->harga_jual;
            Barang::updateBarang($data, decrypt($id));
            return redirect('/barang')->with('success', 'data berhasil di update');
        } catch (\Exception $e) {
            return redirect('/barang')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
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
            Barang::deleteBarang(decrypt($id));
            return redirect('/barang')->with('success', 'data berhasil didelete');
        } catch (\Exception $e) {
            return redirect('/barang')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
}
