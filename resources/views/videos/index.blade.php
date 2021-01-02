@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">影片管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>影片</h1>
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
            <th>連結</th>
            <th>狀態</th>
            <th width="280px">動作</th>
        </tr>
        @foreach ($videos as $video)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $video->proj_name }}</td>
            <td>{{ $video->name }}</td>
            <td>{{ $video->url }}</td>
            <td>{{ ($video->status==1) ? "啟用":"不啟用" }}</td>
            <td>
                <form action="{{ route('videos.destroy',$video->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('videos.show',$video->id) }}">詳情</a>
                    <a class="btn btn-primary" href="{{ route('videos.edit',$video->id) }}">編輯</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $videos->links() !!}
@endsection
