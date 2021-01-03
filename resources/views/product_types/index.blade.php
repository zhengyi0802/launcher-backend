@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">產品型號管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>產品型號</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product_types.create') }}">新增產品型號</a>
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
            <th>產品類別</th>
            <th>描述</th>
            <th>狀態</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($productTypes as $productType)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $productType->name }}</td>
            <td>{{ $productType->catagory_name }}</td>
            <td>{{ $productType->detail }}</td>
            <td>{{ ($productType->status==1) ? "啟用":"不啟用" }}</td>
            <td>
                <form action="{{ route('product_types.destroy',$productType->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('product_types.show',$productType->id) }}">詳情</a>
                    <a class="btn btn-primary" href="{{ route('product_types.edit',$productType->id) }}">編輯</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $productTypes->links() !!}
@endsection
