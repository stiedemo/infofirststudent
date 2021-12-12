@extends('adminlte::page')

@section('title', $userForm->name . ' - Phần mềm thu thập thông tin học sinh đầu khoá')

@section('content_header')
    <div class="row">
        <div class="col-md-12"><h1>Chỉnh sửa biểu mẫu: {{ $userForm->name }}</h1></div>
    </div>
@stop

@section('content')
<form method="POST" action="{{ route('edit', [$userForm->id, $userForm->hash_code]) }}" class="pb-5">
    @csrf
    <div class="form-group">
      <label for="formEditNameInput">Tên biểu mẫu</label>
      <input type="text" name="name" class="form-control" value="{{ $userForm->name }}" id="formEditNameInput">
    </div>

    <div class="form-group">
        <a href="{{ route('create_item', $userForm->id) }}" type="submit" class="btn btn-default"><i class="fa fa-plus"></i> Thêm mới cấu hình</a>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('home') }}" class="btn btn-info">Trở về</a>
  </form>
@foreach ($userForm->UserConfigForms as $userConfigForm)
    <form action="{{ route('edit_item', $userConfigForm->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Tên trường</label>
                    <input type="text" name="name" class="form-control" value="{{ $userConfigForm->name }}">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label>Kiểu</label>
                    <input type="text" name="type" class="form-control" value="{{ $userConfigForm->type }}">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label>Cấu hình</label>
                    <input type="text" name="config_content" class="form-control" value="{{ $userConfigForm->config_content }}">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label>Bắt buộc nhập</label>
                    <div class="form-check form-check-inline">
                        <input {{ $userConfigForm->required ? 'checked' : '' }} value="Có" class="form-check-input" type="radio" name="required">
                        <label class="form-check-label">Có</label>
                        <input {{ ! $userConfigForm->required ? 'checked' : '' }} value="Không" class="form-check-input" type="radio" name="required">
                        <label class="form-check-label">Không</label>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-book"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        </div>
    </form>
@endforeach
@stop

@section('js')

@stop
