@extends('adminlte::page')

@section('title', $userForm->name . ' - Phần mềm thu thập thông tin học sinh đầu khoá')

@section('content_header')
    <div class="row">
        <div class="col-md-12"><h1>Chỉnh sửa biểu mẫu: {{ $userForm->name }}</h1></div>
    </div>
@stop

@section('content')
<form method="POST" action="{{ route('edit', [$userForm->id, $userForm->hash_code]) }}">
    @csrf
    <div class="form-group">
      <label for="formEditNameInput">Tên biểu mẫu</label>
      <input type="text" name="name" class="form-control" value="{{ $userForm->name }}" id="formEditNameInput" placeholder="name@example.com">
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('home') }}" class="btn btn-info">Trở về</a>
  </form>
@stop

@section('js')

@stop
