@extends('layouts.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembelian</title>
</head>

<body>
    
<div class="jumbotron  mt-2" style="padding:0px;">
  <div class="container">
          {{-- @if(Session::get('failed'))
          <div class="alert alert-danger">{{Session::get('failed')}}</div>
          @endif --}}
          <h4><b>{{$letter_type['letter_code']}}</b>{{$letter_type['name_type']}}</h4>
          {{-- <h3>Selamat Datang </h3> --}}
          <p class="lead">Home/ <a href="{{route('letter_type.index')}}">DataKlasifikasiSurat</a>/<a href="#">LihatDataKlasifikasiSurat</a></p>
      </div>
  </div>
<br>
    <div class="card">
        <h5 class="card-header">
          {{-- <a href="{{route('letter_type.download-pdf',$letter_type['id'])}}" class="btn-print">
            Cetak (.pdf)
          </a> --}}
            download</h5>
        <div class="card-body">
          <h5 class="card-title">{{$letter_type['name_type']}}</h5>
          <p class="card-text">{{$letter_type['created_at']}}</p>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="" class="btn btn-primary">download</a>
        </div>
      </div>
</body>
</html>
@endsection
