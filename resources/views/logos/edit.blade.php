@extends('adminlte::page')

@section('title', '朕臨首頁管理系統')

@section('content_header')
    <h1 class="m-0 text-dark">Logo管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>編輯Logo</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('logos.index') }}">返回</a>
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
           <strong>專案名稱 : {{ $project->name }}</strong>
       </div>
    </div>
    <form action="{{ route('logos.update',$logo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Logo名稱:</strong>
                    <input type="text" name="name" value="{{ $logo->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>描述:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $logo->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Logo圖案:</strong>
                    <input type="file" id="image" name="image" accept="image/*" onchange="loadImage(event)">
                    <img src="{{ $logo->url }}" id="preview" >
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
                    <input type="radio" name="status" placeholder="Status" value="1" {{ ($logo->status==1) ? "checked":null }} >啟用
                    <input type="radio" name="status" placeholder="Status" value="0" {{ ($logo->status!=1) ? "checked":null }} >不啟用
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>起始時間:</strong>
                    <input type="datetime_local" name="start_datetime" value="{{ $logo->start_datetime }}" class="form-control" placeholder="Start Date">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>終止時間:</strong>
                    <input type="datetime_local" name="stop_datetime" value="{{ $logo->stop_datetime }}" class="form-control" placeholder="Stop Date">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </form>
@endsection
