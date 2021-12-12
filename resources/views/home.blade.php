@extends('adminlte::page')

@section('title', 'Trang Chủ - Phần Mềm Thu Thập Thông Tin Trong Trường Học')

@section('plugins.DatatablesPlugin', true)

@section('content_header')
    <div class="row">
        <div class="col-md-8"><h1>Trang Chủ - Phần Mềm Thu Thập Thông Tin Trong Trường Học</h1></div>
        <div class="col-md-4 text-right">
            <a href="{{ route('create') }}" class="btn btn-info"><i class="fa fa-plus"></i> Tạo mới biểu mẫu</a>
        </div>
    </div>
@stop

@section('content')
<x-adminlte-datatable id="table1" :heads="$headsUserForms" theme="light" striped hoverable>
    @foreach($userForms as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
@stop
