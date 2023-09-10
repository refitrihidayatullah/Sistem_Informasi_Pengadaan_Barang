@extends('layout.main')
@section('title','Data barang | Create barang')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url('/barang/store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama barang*</label>
                        <input type="text" class="form-control p-2 @error('nama_barang') is-invalid @enderror" value="{{old('nama_barang')}}" id="nama_barang" name="nama_barang" placeholder="masukkan nama barang..">
                        @error('nama_barang')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori*</label>
                        <select class="form-select" name="kategori_id" id="kategori_id" aria-label="Default select example">
                            <option value=""> -- Pilih kategori --</option>
                            @foreach ($data_kategori as $kategori)
                            <option value="{{$kategori->kd_kategori}}" {{ old('kategori_id') == $kategori->kd_kategori ? 'selected' : '' }}>{{$kategori->nama_kategori}}</option>
                            @endforeach
                          </select>
                          @error('kategori_id')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga (kg)*</label>
                        <input type="number" class="form-control p-2 @error('harga') is-invalid @enderror" value="{{old('harga')}}" id="harga" name="harga" placeholder="masukkan nama barang..">
                        @error('harga')
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