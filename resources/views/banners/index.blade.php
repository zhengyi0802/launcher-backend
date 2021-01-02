@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">橫幅廣告管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>橫幅廣告</h1>
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
            <th>專案名稱</th>
            <th>名稱</th>
            <th>圖案</th>
            <th>狀態</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($banners as $banner)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $banner->proj_name }}</td>
            <td>{{ $banner->name }}</td>
            <td><img src="{{ "$banner->url" }}" width="281px" height="81px"></td>
            <td>{{ ($banner->status==1) ? "啟用":"不啟用" }}</td>
            <td>
                <form action="{{ route('banners.destroy',$banner->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('banners.show',$banner->id) }}">詳情</a>
                    <a class="btn btn-primary" href="{{ route('banners.edit',$banner->id) }}">編輯</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
    {!! $banners->links() !!}
@endsection
