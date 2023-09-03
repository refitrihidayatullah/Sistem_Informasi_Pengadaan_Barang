<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Validators\ValidatorRules;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_satuan = Satuan::getAllSatuan();
        return view(
            'satuan.index_satuan',
            [
                'data_satuan' => $data_satuan,
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
        return view('satuan.create_satuan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = ValidatorRules::satuanRules($request->all());
        if ($validator->fails()) {
            return redirect('/satuan/create')->withErrors($validator)->withInput();
        }
        try {
            Satuan::insertSatuan($request->all());
            return redirect('/satuan')->with('success', 'data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/satuan')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
        $satuan = Satuan::getByIdSatuan(decrypt($id));
        return view(
            'satuan.edit_satuan',
            [
                'satuan' => $satuan,
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
        $validator = ValidatorRules::satuanRules($request->all());
        if ($validator->fails()) {
            return redirect("/satuan/" . $id . "/edit")->withErrors($validator)->withInput();
        }
        try {
            $data = $request->except('_token', '_method');
            Satuan::updateSatuan($data, decrypt($id));
            return redirect('/satuan')->with('success', 'data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect('/satuan')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
            Satuan::deleteSatuan(decrypt($id));
            return redirect('/satuan')->with('success', 'data berhasil didelete');
        } catch (\Exception $e) {
            return redirect('/satuan')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
}
