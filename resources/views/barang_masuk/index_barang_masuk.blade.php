@extends('layout.main')
@section('title','Data Barang Masuk')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-white shadow-light border-radius-lg pt-4 pb-3">
            <h6 class="text-dark text-capitalize ps-3">Table Barang Masuk</h6>
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
          <a href="{{url('/barang-masuk/create')}}" class="btn btn-success mx-3">Add Barang Masuk</a>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Barang Masuk</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Masuk</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Supplier</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Barang</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kategori</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Satuan</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stock</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga Beli</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga Jual</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">user</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_barang_masuk as $barang_masuk)  
                <tr>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang_masuk->kd_barang_masuk}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang_masuk->tanggal_masuk}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$barang_masuk->supplier->nama_supplier}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$barang_masuk->barang->nama_barang}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0">{{$barang_masuk->barang->kategori->nama_kategori}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0">{{$barang_masuk->barang->satuan->nama_satuan}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0">{{$barang_masuk->stock}}=>{{$barang_masuk->barang->stock}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0">Rp.{{$barang_masuk->harga_beli}}=>Rp.{{$barang_masuk->barang->harga_beli}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0">Rp.{{$barang_masuk->barang->harga_jual}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0">{{$barang_masuk->user->name}}</p>
                  </td>
                  <td class="align-middle">
                    <a href="#" style="margin-left: 10px" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteBarangMasukModal{{$barang_masuk->buy_id}}">
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
  @foreach ($data_barang_masuk as $barang_masuk) 
<div class="modal fade" id="deleteBarangMasukModal{{$barang_masuk->buy_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{url("/barang-masuk/".encrypt($barang_masuk->buy_id))}}" method="POST">
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
