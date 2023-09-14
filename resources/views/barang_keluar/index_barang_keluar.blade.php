@extends('layout.main')
@section('title','barang_keluar')
@section('content')
<div style="margin-bottom:-40px " class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-body px-4 pb-2">
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
          @php
             use Carbon\carbon;
          @endphp
          <form action="{{url('/barang-keluar')}}" method="POST">
            <div class="d-flex gap-4 p-3 justify-content-center">
              @csrf
                <div class="col-6">
                    <div class="mb-3">
                        <label for="tgl_transaksi" class="form-label">Tanggal Transaksi</label>
                        <input type="text" readonly value="{{Session::get('tgl_transaksi')?Session::get('tgl_transaksi'):carbon::now()->setTimezone('Asia/Jakarta')}}" class="form-control p-2 @error('tgl_transaksi') is-invalid @enderror" id="tgl_transaksi" name="tgl_transaksi">
                        @error('tgl_transaksi')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan*</label>
                        <input type="text" class="form-control p-2 @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" value="{{ old('nama_pelanggan')?: Session::get('nama_pelanggan') }}" {{Session::get('nama_pelanggan')?'readonly':''}} name="nama_pelanggan" placeholder="nama_pelanggan..">
                        @error('nama_pelanggan')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="user_id" class="form-label">kasir*</label>
                        <input type="text" value="{{Auth::user()->name?:'user'}}" readonly class="form-control p-2 @error('user_id') is-invalid @enderror" id="user_id" value="{{old('user_id')}}" name="user_id">
                        @error('user_id')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                      </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="barang_id" class="form-label">Pilih Barang*</label>
                        <select name="barang_id" class="form-select form-select-lg mb-3 @error('barang_id') is-invalid @enderror" aria-label=".form-select-lg example">
                          <option value="">>> pilih barang <<</option>
                            @foreach ($data_barang as $barang)
                            <option value="{{$barang->kd_barang}},{{$barang->harga_beli}},{{$barang->harga_jual}}">{{$barang->nama_barang?:''}} -- {{$barang->kd_barang?:''}}</option>
                            @endforeach
                            @error('barang_id')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                          </select>
                      </div>
                      <div class="mb-3 d-flex gap-1 justify-content-center">
                          <div class="col-6">
                            <label for="jumlah_barang" class="form-label">Jumlah*</label>
                            <input type="number" class="form-control p-2 @error('jumlah_barang') is-invalid @enderror" value="{{old('jumlah_barang')}}" name="jumlah_barang" id="jumlah_barang" placeholder="jumlah barang..">
                            @error('jumlah_barang')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                          </div>
                        <div class="col-6">
                            <label for="diskon_barang" class="form-label">Diskon (%)</label>
                            <input type="number" class="form-control p-2 @error('diskon_barang') is-invalid @enderror" value="0"  name="diskon_barang" id="diskon_barang" placeholder="diskon barang..">
                            @error('diskon_barang')
                            <div class="form-text text-danger">{{$message}}.</div>
                            @enderror
                          </div>
                      </div>     
                      <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
            
          </form>


        </div>
      </div>
    </div>
  </div>


  <div class="row ">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tgl Transaksi</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Barang</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Barang</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diskon</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sub Total</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @php
                    $grandTotal = 0;
                @endphp
                @foreach ($barang_keluar as $brg_keluar)
                <tr>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{$brg_keluar->tanggal_keluar}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs text-secondary mb-0 mx-3">{{$brg_keluar->barang_id}}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs text-secondary mb-0 ">{{$brg_keluar->barang->nama_barang}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs text-secondary mb-0 mx-3">{{$brg_keluar->barang->kategori->nama_kategori}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs text-secondary mb-0 mx-3">Rp.{{$brg_keluar->harga_jual}}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs text-secondary mb-0 mx-3">{{$brg_keluar->diskon}}%</p>
                  </td>
                  <td class="align-middle text-center">
                    <span class="badge badge-sm bg-gradient-success">{{$brg_keluar->jumlah_keluar}}</span>
                  </td>
                  <td class="align-middle text-center">
                    @php
                        $sub_total = $brg_keluar->harga_jual * $brg_keluar->jumlah_keluar *(100 - $brg_keluar->diskon)/100;
                        $grandTotal += $sub_total;
                    @endphp
                    <p class="text-xs text-secondary mb-0 mx-3">Rp.{{number_format($sub_total,2)}}</p>
                  </td>
                  <td class="align-middle">
                    <a href="#" style="margin-left: 10px" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteBarangKeluarModal{{$brg_keluar->kd_barang_keluar}}">
                      Delete
                    </a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
            <div style="background-color:#f5f5f5;border:none;" class="d-flex align-items-center justify-content-end">
  
                <div class="w-35">
                  <form action="{{url("barang-keluar/".encrypt(Session::get('tgl_transaksi')))}}" method="POST">
                    @csrf
                  <input type="hidden" readonly value="{{Session::get('tgl_transaksi')?Session::get('tgl_transaksi'):carbon::now()->setTimezone('Asia/Jakarta')}}" class="form-control p-2" id="tgl_transaksi" name="tgl_transaksi">
                  <input type="hidden" readonly value="{{Session::get('nama_pelanggan')?Session::get('nama_pelanggan'):''}}" class="form-control p-2" id="nama_pelanggan" name="nama_pelanggan">
                    <div class="mb-3 row">
                        <td><label for="grandtotal" class="col-sm-5 col-form-label">Grand Total Belanja(Rp):</label></td>
                        <td >
                            <div class="col-sm-5">
                            <input type="text" readonly class="form-control-plaintext" name="grandtotal" id="grandtotal" value="{{$grandTotal}}"/>
                            </div>
                        </td>
                    </div>
                    <div class="mb-3 row">
                        <td><label for="pembayaran" class="col-sm-5 col-form-label">Pembayaran(Rp)*:</label></td>
                        <td>
                            <div class="col-sm-5">
                                <input type="number" class="form-control bg-white" name="pembayaran" oninput="hitungKembalian()" id="pembayaran">
                              </div>
                        </td>
                    </div>
                    <div class="mb-3 row">
                        <td><label for="kembalian" class="col-sm-5 col-form-label">Kembalian(Rp):</label></td>
                        <td>
                            <div class="col-sm-5">
                                <h3 id="kembalian"></h3>
                            </div>
                        </td>
                    </div>
                    <div class="d-flex gap-4">
                      <a href="{{url("barang-keluar/".encrypt(Session::get('tgl_transaksi')))}}" class="btn btn-danger">Reset</a>
                      <button class="btn btn-success" id="btnbayar" type="submit">Bayar Sekarang</button>
                    </div>
                    
                  </form>
                </div>
            </div>

        
          </div>
        </div>
      </div>
    </div>
  </div>



   <!-- Modal -->
   @foreach ($barang_keluar as $brg_keluar)
   <div class="modal fade" id="deleteBarangKeluarModal{{$brg_keluar->kd_barang_keluar}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
             <form action="{{url("/barang-keluar/".encrypt($brg_keluar->kd_barang_keluar))}}" method="POST">
               @csrf
               @method('delete')
               Yakin Akan Menghapus Data?
               <input type="hidden" name="tanggal_keluar" value="{{$brg_keluar->tanggal_keluar}}">
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