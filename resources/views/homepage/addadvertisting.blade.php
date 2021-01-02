@extends('adminlte::page')

@section('title', '朕臨首頁管理系統')

@section('content_header')
    <h1 class="m-0 text-dark">{{ $proj_name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>新增廣告圖片</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('projects.homepage', $proj_id) }}">返回</a>
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

<form action="{{ route('advertistings.newstore', ['id' => $proj_id, 'position' => $position]) }}" method="POST"  enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>廣告圖片名稱:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>顯示位置: {{ ($position == '1') ? '左上':'左下' }} </strong>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>圖檔上傳:</strong>
                <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <img id="preview" width="315px" height="270px"/>
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
                <strong>描述:</strong>
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>狀態:  </strong>
                <input type="radio" name="status" placeholder="Status" value="1" checked>啟用
                <input type="radio" name="status" placeholder="Status" value="0">不啟用
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>啟用時間:</strong>
                <input type="datetime_local" name="start_datetime" class="form-control" placeholder="Start Date">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>終止時間:</strong>
                <input type="datetime_local" name="stop_datetime" class="form-control" placeholder="Stop Date">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>
</form>
@endsection
