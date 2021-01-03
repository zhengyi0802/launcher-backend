@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">產品狀態管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>產品狀態</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product_statuses.create') }}">新增產品狀態</a>
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
            <th>產品狀態</th>
            <th>描述</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($productStatuses as $productStatus)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $productStatus->name }}</td>
            <td>{{ $productStatus->detail }}</td>
            <td>
                <form action="{{ route('product_statuses.destroy',$productStatus->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('product_statuses.show',$productStatus->id) }}">詳情</a>
                    <a class="btn btn-primary" href="{{ route('product_statuses.edit',$productStatus->id) }}">編輯</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $productStatuses->links() !!}
@endsection
