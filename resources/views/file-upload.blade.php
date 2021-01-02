@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">圖片上傳測試</h1>
@stop

@section('content')
   <script>
     var loadFile = function(event) {
         var output = document.getElementById('preview');
         output.src = URL.createObjectURL(event.target.files[0]);
         output.onload = function() {
           URL.revokeObjectURL(output.src) // free memory
         }
     };
   </script>
    <div class="container mt-5">
        <form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
          <h3 class="text-center mb-5">圖片上傳測試</h3>
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
          @endif

          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif

            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="chooseFile" onchange="loadFile(event)">
                <label class="custom-file-label" for="chooseFile">選擇圖片檔案</label>
            </div>
            <div>
                <img id="preview">
            </div>
            <div class="custome-file">
               <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                   圖片檔案上傳
               </button>
            </div>
        </form>
    </div>

@endsection
