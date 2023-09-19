@extends('layout.main')
@section('title','halaman')
@section('content')
<!-- first alert -->
@if(Session::has('failed'))
<div style="width: 50%" class="alert alert-danger alert-dismissible text-white mx-3" role="alert" id="myAlert">
  <span class="text-sm">Failed {{Session::get('failed')}}.</span>
</div>
@elseif(Session::has('success'))
<div style="width: 50%" class="alert alert-success alert-dismissible text-white" role="alert" id="myAlert">
  <span class="text-sm">Success {{Session::get('success')}}.</span>
</div>
@elseif(Session::has('login'))
<div style="width: 50%" class="alert alert-success alert-dismissible text-white" role="alert" id="myAlert">
    <span class="text-sm"> {{Session::get('login')}}.</span>
  </div>
@else
@endif
<!-- end alert -->
    
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">person</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">new Suppliers</p>
          <h4 class="mb-0">{{$supplier}}</h4>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">+1 </span>Supplier</p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">person</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">New Barang</p>
          <h4 class="mb-0">{{$barang}}</h4>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">+1 </span> barang</p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">person</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">New Barang Masuk</p>
          <h4 class="mb-0">{{$barang_masuk}}</h4>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">+1 </span> barang masuk</p>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-header p-3 pt-2">
        <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
          <i class="material-icons opacity-10">person</i>
        </div>
        <div class="text-end pt-1">
          <p class="text-sm mb-0 text-capitalize">New Barang Keluar</p>
          <h4 class="mb-0">{{$barang_keluar}}</h4>
        </div>
      </div>
      <hr class="dark horizontal my-0">
      <div class="card-footer p-3">
        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">+1 </span> barang keluar</p>
      </div>
    </div>
  </div>
</div>
<div class="row mt-2">
  <div class="col-lg-11.5 col-md-12 mb-md-0 mb-4">
    <div class="card">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-lg-6 col-7">
            <h6>Status Stok Barang</h6>
            <p class="text-sm mb-0">
              <i class="fa fa-check text-info" aria-hidden="true"></i>
              <span class="font-weight-bold ms-1">status stock barang</span> 
            </p>
          </div>
          <div class="col-lg-6 col-5 my-auto text-end">
          </div>
        </div>
      </div>
      <div class="card-body px-0 pb-2">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stock Awal</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock Tersedia</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Persentase</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($hitung_stock_tersedia as $tersedia)
                
                
                <td>
                  <div class="d-flex px-3 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <p class="mb-0 text-lowercase text-sm">{{$tersedia->nama_barang}}</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle px-4  text-sm">
                  @foreach ($hitung_stock_masuk as $masuk)
                  @if($tersedia->kd_barang == $masuk->barang_id )
                  <span class="text-xs font-weight-bold">{{$masuk->total_stock}}</span>
                  @endif
                  @endforeach
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">{{$tersedia->stock}}</span>
                </td>
                
                <td class="align-middle text-center">
                  <div class="progress-wrapper w-75 mx-auto">
                    <div class="progress-info">
                      <div class="progress-percentage">
                        @foreach ($hitung_stock_masuk as $masuk)
                        @if($tersedia->kd_barang == $masuk->barang_id )
                        @php
                          $persentase = $masuk->total_stock && $tersedia->stock > 0 ? ($tersedia->stock/$masuk->total_stock)*100:0;
                          $persentase = intval(str_replace(',', '', $persentase));
                        @endphp
                        <span class="text-xs font-weight-bold">{{$persentase}}%</span>
                        @endif
                        @endforeach
                      </div>
                    </div>
                    @if ($persentase == 100)
                    <div class="progress">
                      <div class="progress-bar bg-gradient-success w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @elseif($persentase >= 80 && $persentase <= 99) 
                    <div class="progress">
                      <div class="progress-bar bg-gradient-info w-80" role="progressbar" aria-valuenow="80" aria-valuemin="80" aria-valuemax="99"></div>
                    </div> 
                    @elseif($persentase >= 50 && $persentase <= 79) 
                    <div class="progress">
                      <div class="progress-bar bg-gradient-info w-60" role="progressbar" aria-valuenow="60" aria-valuemin="50" aria-valuemax="79"></div>
                    </div>
                    @elseif($persentase >=30 && $persentase <= 50) 
                    <div class="progress">
                      <div class="progress-bar bg-gradient-warning w-30" role="progressbar" aria-valuenow="30" aria-valuemin="30" aria-valuemax="50"></div>
                    </div>
                    @elseif($persentase >=1 && $persentase <= 29) 
                    <div class="progress">
                      <div class="progress-bar bg-gradient-danger w-10" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="29"></div>
                    </div>    
                    @else
                    <div class="progress">
                      <div class="progress-bar bg-gradient-info w-0" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="0"></div>
                    </div> 
                    @endif
                    
                  </div>
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

@endsection