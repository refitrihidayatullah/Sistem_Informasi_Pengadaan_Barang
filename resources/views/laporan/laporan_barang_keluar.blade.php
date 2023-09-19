@extends('layout.main')
@section('title','Laporan Barang Keluar')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-white shadow-light border-radius-lg pt-4 pb-3">
            <h6 class="text-dark text-capitalize ps-3">Table Laporan Barang Keluar</h6>
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
          <a href="{{url('/laporan-barang-keluar/export')}}" class="btn btn-success mx-3">EXPORT</a>
          <div style="height:40px; black" class="d-flex">
            <form action="{{url('laporan-barang-masuk')}}" method="GET" class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group input-group-outline">
                <label class="form-label">Type here...</label>
                <input type="text" value="{{Request::get('key')}}" name="keylaporanbarangkeluar" class="form-control">
              </div>
              <button style="align-self:center;margin-top:15px;" class="btn btn-sm w-50 btn-outline-secondary mx-3" type="submit">Search</button>
            </form>
          </div>

          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Barang Keluar</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Transaksi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pelanggan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kasir</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_barang_keluar as $barang_keluar)  
                <tr>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang_keluar->kd_transaksi}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang_keluar->tanggal_keluar}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang_keluar->nama_pelanggan}}</p>
                  </td>
                 
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$barang_keluar->grandtotal}}</p>
                  </td>
                  <td>
                    @foreach ($user_kasir as $kasir)
                    
                    @if($barang_keluar->user_id == $kasir->id )
                    <p class="text-xs text-secondary mb-0">{{$kasir->name}}</p>
                    @endif
                    @endforeach
                  </td>

                  <td class="align-middle">
                   
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>

            <div class="p-3">
              {{ $data_barang_keluar->links()}}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
