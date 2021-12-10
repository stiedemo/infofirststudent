@extends('adminlte::page')

@section('title', 'Trang Chủ - Phần mềm thu thập thông tin học sinh đầu khoá')

@section('plugins.DatatablesPlugin', true)

@section('content_header')
    <h1>Trang Chủ - Phần mềm thu thập thông tin học sinh đầu khoá</h1>
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
