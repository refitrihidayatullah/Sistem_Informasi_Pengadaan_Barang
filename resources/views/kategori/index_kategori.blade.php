@extends('layout.main')
@section('title','Data Kategori')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-white shadow-light border-radius-lg pt-4 pb-3">
            <h6 class="text-dark text-capitalize ps-3">Table Kategori</h6>
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
          <a href="{{url('/kategori/create')}}" class="btn btn-success mx-3">Add Kategori</a>
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Kategori</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Kategori</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_kategori as $kategori)  
                <tr>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$kategori->kd_kategori}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$kategori->nama_kategori}}</p>
                  </td>
                  <td class="align-middle">
                    <a href="{{url("/kategori/".encrypt($kategori->kd_kategori)."/edit")}}" class="text-secondary font-weight-bold text-xs">
                      Edit
                    </a>
                    <a href="#" style="margin-left: 10px" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteKategoriModal{{$kategori->kd_kategori}}">
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
  
  <!-- Modal delete -->
@foreach ($data_kategori as $kategori) 
<div class="modal fade" id="deleteKategoriModal{{$kategori->kd_kategori}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Data kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{url("/kategori/".encrypt($kategori->kd_kategori))}}" method="POST">
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
