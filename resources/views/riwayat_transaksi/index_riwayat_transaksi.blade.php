@extends('layout.main')
@section('title','Data Riwayat Transaksi')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-white shadow-light border-radius-lg pt-4 pb-3">
            <h6 class="text-dark text-capitalize ps-3">Table Riwayat Transaksi</h6>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <!-- first alert -->
          @if(Session::has('failed'))
          <div style="width: 50%" class="alert alert-danger alert-dismissible text-white mx-3" role="alert" id="myAlert">
            <span class="text-sm">Failed {{Session::get('failed')}}.</span>
          </div>
          @elseif(Session::has('success'))
          <div style="width: 50%" class="alert alert-success alert-dismissible text-white" role="alert" id="myAlert">
            <span class="text-sm">Success {{Session::get('success')}}.</span>
          </div>
          @else
          @endif
          <!-- end alert -->
          <a href="{{url('/barang-keluar')}}" class="btn btn-success mx-3">Back</a>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Transaksi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Transaksi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pelanggan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kasir</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transaksi_barang as $transaksi)  
                <tr>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$transaksi->kd_transaksi}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$transaksi->tanggal_keluar}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$transaksi->nama_pelanggan}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">Rp.{{$transaksi->grandtotal}}</p>
                  </td>
                  <td>
                    @foreach ($user_kasir as $kasir)
                    
                    @if($transaksi->user_id == $kasir->id )
                    <p class="text-xs text-secondary mb-0">{{$kasir->name}}</p>
                    @endif
                    @endforeach
                  </td>
                  <td class="align-middle">
                    <a href="{{url("/invoice/".encrypt($transaksi->tanggal_keluar))}}" class="text-secondary font-weight-bold text-xs">
                      Cetak Nota
                    </a>
                    <a href="#" style="margin-left: 10px" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteRiwayatTransaksiModal{{$transaksi->kd_transaksi}}">
                      Delete
                    </a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  @foreach ($transaksi_barang as $transaksi) 
<div class="modal fade" id="deleteRiwayatTransaksiModal{{$transaksi->kd_transaksi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Transaksi Barang Keluar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{url("/riwayat-transaksi/".encrypt($transaksi->kd_transaksi))}}" method="POST">
            @csrf
            @method('delete')
            Yakin Akan Menghapus Data?
            <div style="margin-top: 20px" class="modal-footer">
            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Delete</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
  @endforeach
@endsection
