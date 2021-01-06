@extends('adminlte::page')

@section('title', '朕臨首頁管理系統')

@section('content_header')
    <h1 class="m-0 text-dark">影片管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>影片詳情</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('videos.index') }}">返回</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>專案名稱:</strong>
                {{ $project->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>影片名稱:</strong>
                {{ $video->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>描述:</strong>
                {{ $video->detail }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>影片連結:</strong>
                <img src={{ $video->url }} >
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>狀態:</strong>
                {{ ($video->status==1) ? "啟用":"不啟用" }}
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>起始時間:</strong>
                {{ $video->start_datetime }}
            </div>
        </div>
         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>終止時間:</strong>
                {{ $video->stop_datetime }}
            </div>
        </div>
     </div>
@endsection
