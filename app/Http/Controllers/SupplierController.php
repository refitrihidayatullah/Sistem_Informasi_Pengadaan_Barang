<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Validators\ValidatorRules;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        if (strlen($key)) {
            $data_supplier = Supplier::where('kd_supplier', 'like', "%$key%")
                ->orWhere('nama_supplier', 'like', "%$key%")
                ->orWhere('no_telp_supplier', 'like', "%$key%")
                ->orWhere('alamat_supplier', 'like', "%$key%")
                ->paginate();
        } else {
            $data_supplier = Supplier::getAllSupplierPaginate(5);
        }
        return view(
            'supplier.index_supplier',
            [
                'data_supplier' => $data_supplier,
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
        return view('supplier.create_supplier');
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
        $validator = ValidatorRules::supplierRules($data);
        if ($validator->fails()) {
            return redirect('/supplier/create')->withErrors($validator)->withInput();
        }
        try {
            Supplier::insertSupplier($data);
            return redirect('/supplier')->with('success', 'data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/supplier')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
        $supplier = Supplier::getByIdSupplier(decrypt($id));
        return view(
            'supplier.edit_supplier',
            [
                'supplier' => $supplier,
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
        $data = $request->all();
        $validator = ValidatorRules::supplierRules($data);
        if ($validator->fails()) {
            return redirect("/supplier/" . $id . "/edit")->withErrors($validator)->withInput();
        }
        try {
            $data = $request->except('_token', '_method');
            Supplier::updateSupplier($data, decrypt($id));
            return redirect('/supplier')->with('success', 'data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect('/supplier')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
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
            Supplier::deleteSupplier(decrypt($id));
            return redirect('/supplier')->with('success', 'data berhasil di delete');
        } catch (\Exception $e) {
            return redirect('/supplier')->with('failed', 'Terjadi Kesalahan' . $e->getMessage());
        }
    }
}
