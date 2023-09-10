@extends('layout.main')
@section('title','halaman')
@section('content')
<!-- first alert -->
@if(Session::has('failed'))
<div style="width: 50%" class="alert alert-danger alert-dismissible text-white mx-3" role="alert" id="myAlert">
  <span class="text-sm">Failed {{Session::get('failed')}}.</span>
</div>
@elseif(Session::has('success'))
<div style="width: 50%" class="alert alert-success alert-dismissible text-white" role="alert" id="myAlert">
  <span class="text-sm">Success {{Session::get('success')}}.</span>
</div>
@elseif(Session::has('login'))
<div style="width: 50%" class="alert alert-success alert-dismissible text-white" role="alert" id="myAlert">
    <span class="text-sm"> {{Session::get('login')}}.</span>
  </div>
@else
@endif
<!-- end alert -->
    <h1>hello. {{Auth::user()->name?:''}}</h1>
@endsection