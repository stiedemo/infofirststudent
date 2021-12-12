@extends('adminlte::page')

@section('title', 'Tạo mới biểu mẫu - Phần Mềm Thu Thập Thông Tin Trong Trường Học')

@section('content_header')
    <div class="row">
        <div class="col-md-12"><h1>Tạo mới biểu mẫu</h1></div>
    </div>
@stop

@section('content')
<form method="POST" action="{{ route('create') }}">
    @csrf
    <div class="form-group">
      <label for="formEditNameInput">Tên biểu mẫu</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="formEditNameInput" placeholder="">
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('home') }}" class="btn btn-info">Trở về</a>
  </form>
@stop

@section('js')

@stop
