@extends('adminlte::page')

@section('title', '朕臨首頁管理系統')

@section('content_header')
    <h1 class="m-0 text-dark">產品管理系統</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h1>新增產品</h1>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('machines.index') }}">返回</a>
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

<form action="{{ route('machines.store') }}" method="POST">
    @csrf
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>產品型號:</strong>
                <input type="radio" name="type_id" value="5">Mundi-M5
                <input type="radio" name="type_id" value="4">Mundi-M4
                <input type="radio" name="type_id" value="3">Mundi-M3
                <input type="radio" name="type_id" value="2">Mundi-A3
                <input type="radio" name="type_id" value="1">Mundi-A2
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>序號:</strong>
                <input type="text" name="serialno" class="form-control" placehoder="A1234567890">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>MAC位址:</strong>
                <input type="text" name="mac_address" class="form-control" placeholder="MAC Address">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>專案名稱:</strong>
                <select name="proj_id">
                    @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}"
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>狀態:  </strong>
                <input type="radio" name="status" value="1" checked>已入庫
                <input type="radio" name="status" value="2">公司展示機
                <input type="radio" name="status" value="3">業務機
                <input type="radio" name="status" value="5">已出貨
                <input type="radio" name="status" value="6">已安裝
                <input type="radio" name="status" value="7">退換壞貨
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </div>
</form>
@endsection
