@extends('adminlte::page')

@section('title', '朕臨首頁管理系統')

@section('content_header')
    <h1 class="m-0 text-dark">產品管理系統</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>編輯產品</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}">返回</a>
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

    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>產品型號:</strong>
                    <select name="type_id">
                        @foreach($productTypes as $productType)
                           <option value="{{ $productType->id }}" {{ ($productType->id == $product->type_id) ? "selected" : null }} >{{ $productType->name ?? '' }}</option
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>產品序號:</strong>
                    <input type="text" name="serialno" value="{{ $product->serialno }}" class="form-control">
                </div>
            </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>專案名稱:</strong>
                    <select name="proj_id">
                           <option value="0" {{ ($product->proj_id == 0) ? "selected" : null }} >--------</option>
                        @foreach($projects as $project)
                           <option value="{{ $project->id }}" {{ ($project->id == $product->proj_id) ? "selected" : null }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>MAC位址:</strong>
                    <input type="text" name="mac_address" value="{{ $product->mac_address }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>狀態:  </strong>
                    <select name="status_id">
                        @foreach($productStatuses as $productStatus)
                           <option value="{{ $productStatus->id }}" {{ ($productStatus->id == $product->status_id) ? "selected" : null }}>{{ $productStatus->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
    </form>
@endsection
