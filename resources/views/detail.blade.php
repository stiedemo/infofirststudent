@extends('adminlte::page')

@section('title', $userForm->name . ' - Phần Mềm Thu Thập Thông Tin Trong Trường Học')

@section('content_header')
    <div class="row">
        <div class="col-md-8"><h1>Chi tiết biểu mẫu: {{ $userForm->name }}</h1></div>
        <div class="col-md-4 text-right">
            <a href="{{ route('download_student_excel', [$userForm->id]) }}" class="btn btn-info">Excel <i class="fa fa-file"></i></a>
            @if($userForm->public == 0)
                <a href="{{ route('switch_status', [$userForm->id, $userForm->hash_code]) }}" class="btn btn-primary">Công khai</a>
            @else
                <a href="{{ route('switch_status', [$userForm->id, $userForm->hash_code]) }}" class="btn btn-danger">Ngừng thu thập</a>
                <button onclick="copyContent('{{ route('write_student', $userForm->hash_code) }}')" class="btn btn-default">Copy link <i class="fa fa-link"></i></button>
            @endif
        </div>
    </div>
@stop

@section('content')
    <x-adminlte-datatable id="table1" :heads="$tableUserStudentHeader" theme="light" striped hoverable>
        @foreach($tableUserStudentData as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>

    @foreach ($userForm->UserStudentForms as $userStudentForm)
    <x-adminlte-modal id="modalCustomFormStudent{{ $userStudentForm->id }}" title="Chi tiết bản thu thập" size="lg" theme="teal"
    icon="fas fa-bell" v-centered static-backdrop scrollable>
        <ul class="list-group">
            @foreach ($userStudentForm->UserStudentItemForms as $userStudentItemForm)
            <li class="list-group-item"><strong>{{ $userStudentItemForm->UserConfigForm->name }}</strong>: {{ $userStudentItemForm->value }}</li>
            @endforeach
        </ul>
    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Đóng" data-dismiss="modal"/>
    </x-slot>
    </x-adminlte-modal>
    @endforeach
@stop

@section('js')
<script>
    function copyContent(content) {
        const body = document.querySelector('body');
        const area = document.createElement('textarea');
        body.appendChild(area);
        area.value = content;
        area.select();
        document.execCommand('copy');
        body.removeChild(area);
        $(document).Toasts('create', {
            title: 'Thành công',
            body: 'Copy đường dẫn thành công !',
            position: 'bottomRight',
            autohide: true,
            delay: 3000,
            class: 't-suss'
        })
    }
</script>
@stop
