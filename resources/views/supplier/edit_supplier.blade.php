@extends('layout.main')
@section('title','Data Supplier | Edit Supplier')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-body px-4 pb-2">
                <form action="{{url("/supplier/".encrypt($supplier->kd_supplier))}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control p-2 @error('nama_supplier') is-invalid @enderror" value="{{old('nama_supplier') ?:$supplier->nama_supplier}}" id="nama_supplier" name="nama_supplier" placeholder="masukkan nama supplier..">
                        @error('nama_supplier')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telp_supplier" class="form-label">No Telp</label>
                        <input type="number" class="form-control p-2 @error('no_telp_supplier') is-invalid @enderror" minlength="10" min="10" value="{{old('no_telp_supplier')?:$supplier->no_telp_supplier}}" id="no_telp_supplier" name="no_telp_supplier" placeholder="masukkan no telp..">
                        @error('no_telp_supplier')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat_supplier" class="form-label">Alamat</label>
                        <textarea class="form-control p-2 @error('alamat_supplier') is-invalid @enderror" name="alamat_supplier" id="alamat_supplier" placeholder="alamat_supplier.." rows="3">{{ old('alamat_supplier')?:$supplier->alamat_supplier }}</textarea>
                        @error('alamat_supplier')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/supplier')}}" class="btn btn-primary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection