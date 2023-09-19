@extends('layout.main')
@section('title','Data Supplier')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-white shadow-light border-radius-lg pt-4 pb-3">
            <h6 class="text-dark text-capitalize ps-3">Table Supplier</h6>
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
          <a href="{{url('/supplier/create')}}" class="btn btn-success mx-3">Add Supplier</a>

          <div style="height:40px; black" class="d-flex">
            <form action="{{url('supplier')}}" method="GET" class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group input-group-outline">
                <label class="form-label">Type here...</label>
                <input type="text" value="{{Request::get('key')}}" name="key" class="form-control">
              </div>
              <button style="align-self:center;margin-top:15px;" class="btn btn-sm w-50 btn-outline-secondary mx-3" type="submit">Search</button>
            </form>
          </div>

          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Supplier</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Supplier</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">No Telp</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_supplier as $supplier)  
                <tr>
                  <td>
                    <p class="text-xs text-secondary mb-0 mx-3">{{$supplier->kd_supplier}}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{$supplier->nama_supplier}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0">{{$supplier->no_telp_supplier}}</p>
                  </td>
                  <td>
                    <p class="text-xs text-secondary mb-0">{{$supplier->alamat_supplier}}</p>
                  </td>
                  <td class="align-middle">
                    <a href="{{url("/supplier/".encrypt($supplier->kd_supplier)."/edit")}}" class="text-secondary font-weight-bold text-xs">
                      Edit
                    </a>
                    <a href="#" style="margin-left: 10px" class="text-danger font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#deleteSupplierModal{{$supplier->kd_supplier}}">
                      Delete
                    </a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
            <div class="p-3">
              {{ $data_supplier->links()}}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal -->
    @foreach ($data_supplier as $supplier)  
    <div class="modal fade" id="deleteSupplierModal{{$supplier->kd_supplier}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Supplier</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{url("/supplier/".encrypt($supplier->kd_supplier))}}" method="POST">
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