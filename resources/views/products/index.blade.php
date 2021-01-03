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
                <a class="btn btn-success" href="{{ route('products.create') }}">新增產品</a>
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
            <th>產品序號</th>
            <th>產品型號</th>
            <th>MAC位址</th>
            <th>狀態</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->serialno }}</td>
            <td>{{ $product->type_name }}</td>
            <td>{{ $product->mac_address }}</td>
            <td>{{ $product->status_name }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">詳情</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">編輯</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $products->links() !!}
@endsection
