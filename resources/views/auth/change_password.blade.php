@extends('layout.main')
@section('title','Change Password')
@section('content')
<div class="row">
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
                <form action="{{url('/change-password')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="password_old" class="form-label">Password Old</label>
                        <input type="password" class="form-control p-2 @error('password_old') is-invalid @enderror" value="{{old('password_old')}}" id="password_old" name="password_old" placeholder="masukkan password lama...">
                        @error('password_old')
                        <div class="form-text text-danger">{{$message}}.</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="password_new" class="form-label">Password New</label>
                      <input type="password" class="form-control p-2 @error('password_new') is-invalid @enderror" value="{{old('password_new')}}" id="password_new" name="password_new" placeholder="masukkan password baru...">
                      @error('password_new')
                      <div class="form-text text-danger">{{$message}}.</div>
                      @enderror
                  </div>
                  <div class="mb-3">
                    <label for="password_confirm" class="form-label">Password Confirm</label>
                    <input type="password" class="form-control p-2 @error('password_confirm') is-invalid @enderror" value="{{old('password_confirm')}}" id="password_confirm" name="password_confirm" placeholder="masukkan password baru...">
                    @error('password_confirm')
                    <div class="form-text text-danger">{{$message}}.</div>
                    @enderror
                </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{url('/dashboard')}}"  class="btn btn-primary">Back</a>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection