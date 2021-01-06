@extends('adminlte::page')

@section('title', '朕臨首頁管理系統')

@section('content_header')
    <h1 class="m-0 text-dark">快訊管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>編輯快訊</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('infos.index') }}">返回</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('info_contents.edit') }}">編輯快訊內容</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12">
           <strong>專案名稱 : {{ $proj_name }}</strong>
       </div>
    </div>
    <form action="{{ route('infos.update',$info->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>名稱:</strong>
                    <input type="text" name="name" value="{{ $info->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>描述:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $info->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>圖案:</strong>
                    <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)">
                    <img src="{{ $info->url }}" id="preview" >
                </div>
            </div>
            <script>
                var loadImage = function(event) {
                    var output = document.getElementById('preview');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                       URL.revokeObjectURL(output.src) // free memory
                    }
                };
            </script>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>狀態:  </strong>
                    <input type="radio" name="status" placeholder="Status" value="1" {{ ($info->status==1) ? "checked":null }} >啟用
                    <input type="radio" name="status" placeholder="Status" value="0" {{ ($info->status!=1) ? "checked":null }} >不啟用
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>起始時間:</strong>
                    <input type="datetime_local" name="start_datetime" value="{{ $info->start_datetime }}" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>終止時間:</strong>
                    <input type="datetime_local" name="stop_datetime" value="{{ $info->stop_datetime }}" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </form>
@endsection
