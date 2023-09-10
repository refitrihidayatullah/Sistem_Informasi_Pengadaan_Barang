@extends('layout.main')
@section('title','Data barang | Create barang')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url('/barang-masuk/store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk*</label>
                        <input type="date" class="form-control p-2 @error('tanggal_masuk') is-invalid @enderror" value="{{date('Y-m-d')}}" id="tanggal_masuk" name="tanggal_masuk">
                        @error('tanggal_masuk')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kd_barang" class="form-label">Nama Barang*</label>
                        <select class="form-select" name="kd_barang" id="kd_barang" aria-label="Default select example">
                            <option value=""> -- Pilih Barang --</option>
                            @foreach ($data_barang as $barang)
                            <option value="{{$barang->kd_barang}}">{{$barang->nama_barang}} -- {{ $barang->kd_barang}}</option>
                            @endforeach
                          </select>
                          @error('kd_barang')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kd_supplier" class="form-label">Nama Supplier*</label>
                        <select class="form-select" name="kd_supplier" id="kd_supplier" aria-label="Default select example">
                            <option value=""> -- Pilih Supplier --</option>
                            @foreach ($data_supplier as $supplier)
                            <option value="{{$supplier->kd_supplier}}">{{$supplier->nama_supplier}} -- {{ $supplier->kd_supplier}}</option>
                            @endforeach
                          </select>
                          @error('kd_supplier')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga beli*</label>
                        <input type="number" class="form-control p-2 @error('harga_beli') is-invalid @enderror" value="{{old('harga_beli')}}" id="harga" name="harga_beli" placeholder="masukkan harga beli barang..">
                        @error('harga_beli')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_masuk" class="form-label">Jumlah*</label>
                        <input type="number" class="form-control p-2 @error('jumlah_masuk') is-invalid @enderror" value="{{old('jumlah_masuk')}}" id="jumlah_masuk" name="jumlah_masuk" placeholder="masukkan jumlah barang..">
                        @error('jumlah_masuk')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual*</label>
                            <input type="number" class="form-control p-2 @error('harga_jual') is-invalid @enderror" value="{{old('harga_jual')}}" id="harga_jual" name="harga_jual" placeholder="masukkan harga jual barang..">
                            @error('harga_jual')
                            <div class="form-text text-danger">{{$message}}.</div>
                            @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/barang')}}"  class="btn btn-primary">Back</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection