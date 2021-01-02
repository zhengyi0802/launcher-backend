@extends('adminlte::page')

@section('title', '朕臨首頁管理系統')

@section('content_header')
    <h1 class="m-0 text-dark">跑馬燈管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>編輯跑馬燈</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('marquees.index') }}">返回</a>
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
            <strong>專案名稱: {{ $proj_name }}</strong>
        </div>
    </div>
    <form action="{{ route('marquees.update',$marquee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>名稱:</strong>
                    <input type="text" name="name" value="{{ $marquee->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>順序:</strong>
                    <input type="text" name="index" value="{{ $marquee->index }}" class="form-control" placeholder="Index">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>跑馬燈文字:</strong>
                    <input type="text" name="marquee" value="{{ $marquee->name }}" class="form-control" placeholder="Marquee">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>狀態:  </strong>
                    <input type="radio" name="status" placeholder="Status" value="1" {{ ($marquee->status==1) ? "checked":null }} >啟用
                    <input type="radio" name="status" placeholder="Status" value="0" {{ ($marquee->status!=1) ? "checked":null }} >不啟用
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>起始時間:</strong>
                    <input type="datetime_local" name="start_datetime" value="{{ $marquee->start_datetime }}" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>終止時間:</strong>
                    <input type="datetime_local" name="stop_datetime" value="{{ $marquee->stop_datetime }}" class="form-control" placeholder="YYYY-MM-DD hh:mm:ss">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </form>
@endsection
