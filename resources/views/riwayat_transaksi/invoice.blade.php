<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <div class="container"style="max-width:300px;
    height:auto;">
        <div class="header text-center">
            <h4 style="text-align: center">Toko Ragil Jaya</h4>
        </div>
        --------------------------------------------------------
        <table style="margin:2px 12px;">
            <tr>
                <td style="font-size: 12px;">No Transaksi</td>
                <td style="font-size: 12px;">: {{$data_transaksi->kd_transaksi}}</td>
            </tr>
            <tr>
                <td style="font-size: 12px;">Nama Pelanggan</td>
                <td style="font-size: 12px;">: {{$data_transaksi->nama_pelanggan}}</td>
            </tr>
            <tr>
                <td style="font-size: 12px;">kasir</td>
                @foreach ($user_kasir as $kasir)   
                @if($data_transaksi->user_id == $kasir->id)
                <td style="font-size: 12px;">: {{$kasir->name}}</td>
                @endif
                @endforeach
            </tr>
            <tr>
                <td style="font-size: 12px;">Tanggal</td>
                <td style="font-size: 12px;">: {{$data_transaksi->tanggal_keluar}}</td>
            </tr>
        </table>
        --------------------------------------------------------
        <table style="width:100%;">
            <tr>
                <td style="font-size: 12px;">Product</td>
                <td style="font-size: 12px;">Qty/Harga/Disc</td>
                <td style="font-size: 12px;">Total Harga</td>
            </tr>
            @foreach ($data_barang as $barang)
            <tr>
                @foreach ($master_barang as $master)
                @if($barang->barang_id == $master->kd_barang)
                <td style="font-size: 10px;">{{$master->nama_barang}}</td>
                @endif
                @endforeach
                <td style="font-size: 12px;">Rp.{{$barang->stock}}x{{$barang->harga_jual}}/{{$barang->diskon}}</td>
                <td style="font-size: 12px;">Rp.{{$barang->harga_jual * $barang->stock}}</td>
            </tr>
                @endforeach
        </table>
        --------------------------------------------------------
        <table style="width:100%;">
            <tr>
                <td></td>
                <td style="font-size: 12px;">Grandtotal: Rp.{{$data_transaksi->grandtotal}}</td>
            </tr>
            <tr>
                <td style="color:white;">1111111111111111</td>
                <td style="font-size: 12px;">Pembayaran: Rp.{{$data_transaksi->pembayaran}}</td>
            </tr>
            <tr>
                <td></td>
                <td style="font-size: 12px;">Kembalian: Rp.{{$data_transaksi->kembalian}}</td>
            </tr>
        </table>
        --------------------------------------------------------
        <h5 style="text-align: center;">Terima Kasih</h5>
        <p style="text-align: center;font-size: 12px;">Silahkan Berkunjung Kembali</p>
        --------------------------------------------------------
    </div>
</body>
</html>