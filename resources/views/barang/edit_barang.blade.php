@extends('layout.main')
@section('title','Data Barang | Edit Barang')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url("/barang/".encrypt($barang->kd_barang))}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama barang*</label>
                        <input type="text" class="form-control p-2 @error('nama_barang') is-invalid @enderror" value="{{old('nama_barang')?:$barang->nama_barang}}" id="nama_barang" name="nama_barang" placeholder="masukkan nama barang..">
                        @error('nama_barang')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori*</label>
                        <select class="form-select p-2" name="kategori_id" id="kategori_id" aria-label="Default select example">
                            @foreach ($data_kategori as $kategori)
                            <option value="{{$barang->kategori_id === $kategori->kd_kategori ? $barang->kategori_id:$kategori->kd_kategori }}" {{ $barang->kategori_id === $kategori->kd_kategori ? 'selected' : '' }}>{{$kategori->nama_kategori}}</option>
                            @endforeach
                          </select>
                          @error('kategori_id')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="satuan_id" class="form-label">Satuan*</label>
                        <select class="form-select p-2" name="satuan_id" id="satuan_id" aria-label="Default select example">
                            @foreach ($data_satuan as $satuan)
                            <option value="{{$barang->satuan_id === $satuan->kd_satuan?$barang->satuan_id:$satuan->kd_satuan}}" {{ $barang->satuan_id === $satuan->kd_satuan? 'selected' : '' }}>{{$satuan->nama_satuan}}</option>
                            @endforeach
                          </select>
                          @error('satuan_id')
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