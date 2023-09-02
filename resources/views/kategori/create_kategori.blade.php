@extends('layout.main')
@section('title','Data Kategori | Create Kategori')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url('/kategori/store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control p-2 @error('nama_kategori') is-invalid @enderror" value="{{old('nama_kategori')}}" id="nama_kategori" name="nama_kategori" placeholder="masukkan nama kategori..">
                        @error('nama_kategori')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/kategori')}}"  class="btn btn-primary">Back</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection