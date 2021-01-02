@extends('adminlte::page')

@section('title', '朕臨首頁管理系統')

@section('content_header')
    <h1 class="m-0 text-dark">{{ $project->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>新增跑馬燈</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('projects.homepage', $project->id) }}">返回</a>
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

<form action="{{ route('marquees.newstore', $project->id) }}" method="POST"  enctype="multipart/form-data">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>跑馬燈名稱:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第一則:</strong>
                <input class="form-control" name="marquee1" placeholder="Marquee1">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第二則:</strong>
                <input class="form-control" name="marquee2" placeholder="Marquee2">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第三則:</strong>
                <input class="form-control" name="marquee3" placeholder="Narquee3">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第四則:</strong>
                <input class="form-control" name="marquee4" placeholder="Marquee4">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第五則:</strong>
                <input class="form-control" name="marquee5" placeholder="Marquee5">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第六則:</strong>
                <input class="form-control" name="marquee6" placeholder="Marquee6">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第七則:</strong>
                <input class="form-control" name="marquee7" placeholder="Marquee7">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第八則:</strong>
                <input class="form-control" name="marquee8" placeholder="Marquee8">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第九則:</strong>
                <input class="form-control" name="marquee9" placeholder="Marquee9">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>第十則:</strong>
                <input class="form-control" name="marquee10" placeholder="Marquee10">
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
