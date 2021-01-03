@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">產品管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>產品</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('machines.create') }}">新增產品</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>編號</th>
            <th>產品型號</th>
            <th>序號</th>
            <th>Mac位址</th>
            <th>專案名稱</th>
            <th>狀態</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($machines as $machine)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $machine->type }}</td>
            <td>{{ $machine->serialno }}</td>
            <td>{{ $machine->mac_address }}</td>
            <td>{{ $machine->proj_name }}</td>
            <td>{{ ($machine->status==1) ? "啟用":"不啟用" }}</td>
            <td>
                <form action="{{ route('machines.destroy',$machine->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('machines.show',$machine->id) }}">詳情</a>
                    <a class="btn btn-primary" href="{{ route('machines.edit',$machine->id) }}">編輯</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $machines->links() !!}
@endsection
