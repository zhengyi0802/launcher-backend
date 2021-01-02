@extends('adminlte::page')

@section('title', '朕臨首頁設計')

@section('content_header')
    <h1 class="m-0 text-dark">首頁管理系統</h1>
@stop

@section('content')
    <style>
      img {
        width: 90%;
        height: 90%;
      }
    </style>

    <div class="pull-right">
       <h2>專案名稱: {{ $project->name }}</h2>
    </div>

    <table class="table table-bordered" width="90%">
      <tr>
          <td style=" border:1px solid #8E8E8E;" colspan="2">
           <a href="{{ route('homepage.addlogo', $project->id) }}">
              <img src="../../img/UI_1.png">
           </a>
         </td>
         <td style=" border:1px solid #8E8E8E;"  colspan="5">
           <a href="{{ route('homepage.addbanner', $project->id) }}">
              <img src="../../img/UI_2.png">
           </a>
         </td>
         <td style=" border:1px solid #8E8E8E;" colspan="2" ALIGN=CENTER>
           <img src="../../img/UI_3.png">
         </td>
      </tr>
      <tr>
         <td style=" border:1px solid #8E8E8E;" rowspan="2"colspan="2" ALIGN=CENTER>
           <a href="{{ route('homepage.addadvertisting', ['id' => $project->id, 'position' =>'1']) }}">
             <img src="../../img/UI_4.png">
           </a>
         </td>
         <td style=" border:1px solid #8E8E8E;" rowspan="4"colspan="5" ALIGN=CENTER>
           <a href="{{ route('homepage.addvideo', $project->id) }}">
             <img src="../../img/UI_6.png">
           </a>
         </td>
         <td style=" border:1px solid #8E8E8E;" colspan="2"  ALIGN=CENTER>
           <a href="{{ route('homepage.addannounce', $project->id) }}">
             <img src="../../img/UI_7.png">
           </a>
         </td>
      </tr>
      <tr>
         <td style=" border:1px solid #8E8E8E;" colspan="2" ALIGN=CENTER>
           <a href="{{ route('homepage.addinformations', $project->id) }}">
             <img src="../../img/UI_8.png">
           </a>
         </td>
      </tr>
      <tr>
         <td style=" border:1px solid #8E8E8E;" colspan="2"   rowspan="2" ALIGN=CENTER>
           <a href="{{ route('homepage.addadvertisting', ['id' => $project->id, 'position' => '2']) }}">
             <img src="../../img/UI_5.png">
           </a>
         </td>
         <td style=" border:1px solid #8E8E8E;" colspan="2" ALIGN=CENTER>
           <a href="{{ route('homepage.addhelp', $project->id) }}">
             <img src="../../img/UI_9.png">
           </a>
         </td>
      </tr>
      <tr>
         <td style=" border:1px solid #8E8E8E;" colspan="2" ALIGN=CENTER >
           <a href="{{ route('homepage.addmore', $project->id) }}">
             <img src="../../img/UI_10.png">
           </a>
         </td>
      </tr>
      <tr>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
           <img src="../../img/UI_11.png">
         </td>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
           <img src="../../img/UI_12.png">
         </td>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
           <img src="../../img/UI_13.png">
         </td>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
           <img src="../../img/UI_14.png">
         </td>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
           <img src="../../img/UI_15.png">
         </td>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
           <img src="../../img/UI_16.png">
         </td>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
           <img src="../../img/UI_17.png">
         </td>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
           <img src="../../img/UI_18.png">
         </td>
         <td style=" border:1px solid #8E8E8E;" ALIGN=CENTER>
            <img src="../../img/UI_19.png">
         </td>
      </tr>
      <tr>
         <td style=" border:1px solid #8E8E8E; height: 59px;" colspan="9" ALIGN=CENTER>
             <a href="{{ route('homepage.addmarquee', $project->id) }}">
               <img src="../../img/UI_20.png">
             </a>
         </td>
      </tr>
    </table>

@endsection
