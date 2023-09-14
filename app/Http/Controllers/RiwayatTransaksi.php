<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatTransaksi extends Controller
{
    public function index()
    {
        return view('riwayat_transaksi.index_riwayat_transaksi');
    }
}
