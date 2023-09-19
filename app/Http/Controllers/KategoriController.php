<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Validators\ValidatorRules;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->keykategori;
        if (strlen($key)) {
            $data_kategori = Kategori::where('kd_kategori', 'like', "%$key%")
                ->orWhere('nama_kategori', 'like', "%$key%")
                ->paginate();
        } else {
            $data_kategori = Kategori::getAllKategoriPaginate(5);
        }
        return view(
            'kategori.index_kategori',
            [
                'data_kategori' => $data_kategori,
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
        return view('kategori.create_kategori');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = ValidatorRules::kategoriRules($data);
        if ($validator->fails()) {
            return redirect('/kategori/create')->withErrors($validator)->withInput();
        }
        try {
            Kategori::insertKategori($request->all());
            return redirect('/kategori')->with('success', 'data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/kategori')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
        $kategori = Kategori::getByIdKategori(decrypt($id));
        return view(
            'kategori.edit_kategori',
            [
                'kategori' => $kategori
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
        $validator = ValidatorRules::kategoriRules($request->all());
        if ($validator->fails()) {
            return redirect("/kategori/" . $id . "/edit")->withErrors($validator)->withInput();
        }
        try {
            $data = $request->except('_token', '_method');
            Kategori::updateKategori($data, decrypt($id));
            return redirect('/kategori')->with('success', 'data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect('/kategori')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
            Kategori::deleteKategori(decrypt($id));
            return redirect('/kategori')->with('success', 'data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect('/kategori')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
}
