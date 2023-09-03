@extends('layout.main')
@section('title','Data Satuan | Create Satuan')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url('/satuan/store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_satuan" class="form-label">Nama satuan</label>
                        <input type="text" class="form-control p-2 @error('nama_satuan') is-invalid @enderror" value="{{old('nama_satuan')}}" id="nama_satuan" name="nama_satuan" placeholder="masukkan nama satuan..">
                        @error('nama_satuan')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/satuan')}}"  class="btn btn-primary">Back</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection