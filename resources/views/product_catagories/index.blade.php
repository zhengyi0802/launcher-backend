@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">產品類別管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>產品類別</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product_catagories.create') }}">新增產品類別</a>
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
            <th>產品類別名稱</th>
            <th>描述</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($productCatagories as $productCatagory)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $productCatagory->name }}</td>
            <td>{{ $productCatagory->detail }}</td>
            <td>
                <form action="{{ route('product_catagories.destroy',$productCatagory->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('product_catagories.show',$productCatagory->id) }}">詳情</a>
                    <a class="btn btn-primary" href="{{ route('product_catagories.edit',$productCatagory->id) }}">編輯</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $productCatagories->links() !!}
@endsection
