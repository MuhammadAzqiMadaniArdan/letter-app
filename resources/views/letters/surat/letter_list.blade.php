@extends('layouts.template')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembelian</title>
    <style>
      body{
        background: linear-gradient(135deg,rgb(202, 202, 255),white);
      }
      /* #back-wrap {
          margin: 30px auto 0 auto;
          width: 900px;
          display: flex;
          justify-content: flex-end;
      }
      .btn-back {
          
          width: fit-content;
          padding: 8px 15px;
          color: #fff;
          background: #666;
          border-radius: 5px;
          text-decoration: none;
      } */
      .card{
          width: 100%;
          margin-bottom:50px;
          /* margin-top: 80px; */

      }
      .cnt{
          width: 100%
      }
      #receipt {
          /* background-image: url(.././img/wikrama-letter.png); */
          box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
          padding: 20px;
          margin: 30px auto 0 auto;
          width: 900px;
          /* margin: 40px; */
          background: #FFF;
          margin-bottom: 40px;
      }
      h2 {
          font-size: .9rem;
      }
      p {
          font-size: .9rem bold;
          color: black;
          font-weight: 400 bolder;
          line-height: 1.2rem;
      }

      #top {
          margin-top: 25px;
      }
      #top .info {
          /* background-image: url("{{ asset('img/wikrama-top.png') }}"); */
          /* background-size:100%; */
          text-align: left;
          margin: 20px 0;
          width: 100%;
          /* height: 150%; */
          /* padding-bottom: 7%; */
          /* margin-top: 100px; */
          display: flex;
          justify-content: space-between
      }
      #top .info .T1{
          text-align: center;
          /* display: flex; */
          width: 20%;
          margin-top: 30px;
          /* justify-content: center; */
      }
      #top .info .T2{
          margin-right: 60px;
          width: 40%
      }
      #top .info .address{
          margin-right: 0px;
          width: 30%
      }

      #mid .C1{
          text-align: end;
          margin-right: 60px
      }
      #mid .C2{
          margin: 0 20px;
          display: flex;
          justify-content: space-between;
      }
      #mid .C2 .Card2{
          margin-right: 120px;
      }
      #mid .info{
          margin:0 40px;
      }
      #foot{
          text-align: end;
          margin-right: 40px;
      }
      
  </style>
</head>

<body>
  <div class="jumbotron  mt-2" style="padding:0px;">
    <div class="container">
            {{-- @if(Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif --}}
            <h3><b>Data Surat</b> </h3>
            <p class="lead">Home/ <a href="{{route('letter.index')}}">DataSurat</a>/<a href="#">LihatDataSurat</a></p>
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
          <h5 class="card-title"></h5>
          <div id="receipt">
            <div class="cnt">
            <center id="top">
                <div class="info">
                    <div class="T1">
                    {{-- <img src={{ asset('img/wikrama-letter.png') }} style="800px">  --}}
                    <img src="https://smkwikrama.sch.id/assets2/wikrama-logo.png" alt="" style="width: 100px">
                </div>
                    <div class="T2">
                    <h3>SMK WIKRAMA BOGOR
                    </h3><hr>
                    <p>Managemen dan Bisnis </br>
                        Teknik Informasi dan Komunikasi</br>
                        Pemasaran
                    </p>
                </div>
                    <div class="address">
                        <p>Jl.Raya Wangun Ke.SindangSari BOGOR </br>
                        Telp/Faks : 02518242411 </br>
                        e-mail:prohumasi@smkwikrama.sch.id</br>
                        Website:www.smkwikrama.sch.id
                        </p>
                    </div>
                </div>
            </center>
             <strong><hr style="border: none; height: 2px; background-color: black;">
             </strong>
            <div id="mid">
                <div class="C1">
                    @php
                    // setLocale(LC_ALL, 'id_ID');
                    setLocale(LC_TIME, 'id_ID');
                    @endphp
                    <p style="font-weight: 200">{{ Carbon\Carbon::parse($letter['created_at'])->formatLocalized('%d %B %Y') }}</p>
                </div>
                <div class="C2">
                    <div class="Card1">
                        <p>No: {{$letter['letter_type_id']}}</br>
                        Hal: <b>{{$letter['letter_perihal']}} </b></p>
                    </div>
                    <div class="Card2">
                        <p>Kepada</p>
                        <p>Yth.Bapak/Ibu Terlampir</br>
                            di</br>
                            Tempat
                        </p>
                    </div>
                </div>
                <div class="info">
                    <p>
                        Assalamualaikum Wr.Wb. </br>
                        Sehubungan dengan dilaksanakannya Kegiatan <b>
                            {{$letter['letter_perihal']}} </b> maka dengan ini kami mengundang seluruh Bapak/Ibu Guru & Laboran untuk hadir pada upacara rapat yang akan dilaksanakan pada : </br>
                        Hari, Tanggal : {{ Carbon\Carbon::parse($letter['created_at'])->formatLocalized('%A, %d %B %Y') }} </br>
                        Waktu: 16.00 - Selesai </br>
                        Tempat : WorkShop Guru </br>
                        Agenda : 1.Laporan KBM Reguler </br>
                        2.Penyusunan Waktu Kegiatan PAS tiap Mapel </br>
                        <br>
                        Demikian undangan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih. </br>
                        Wassalamualaikum Wr. Wb
                    </p>
                    {{-- <p class="trix-content">
                      @php
                      $content = strip_tags($letter->content);
                      @endphp
                      {{$content}}
                    </p> --}}
                    <br>
                    <p>
                        Peserta :
                    </p>
                    <td>{{ $letter->user->name }}</td>
                    {{-- <p>{{$letter['notulis']}}</p> --}}
                </div>
    
            </div>
            <div id="foot">
                <p>Hormat Kami,</br>
                Kepala SMK Wikrama Bogor</p>
                <p style="margin-top: 20%;margin-left:30px;">(...........................)</p>
            </div>
        </div>
    </div>
          {{-- <p class="card-text">
            With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a> --}}
        </div>
      </div>
      <div class="card">
        {{-- <h5 class="card-header"> --}}
          {{-- <a href="{{route('letter_type.download-pdf',$letter_type['id'])}}" class="btn-print">
            Cetak (.pdf)
          </a> --}}
            {{-- download</h5> --}}
        <div class="card-body">
          <p class="card-text" style="margin-top: 1%">Peserta yang hadir :</p>
          <table class="table mt-2 table-bordered table-hovered ">
            <thead>
                <tr>
    
                    <th>Nama</th>
                    <th>Kehadiran</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($recipients as $item)
              <tr>
                <td>{{ $item['name_recipients'] }}</td>
                <td>
                    <div class="col-sm-10">
                        <div class="form-check">
                            @php
                            // Check if the current recipient ID exists in the selected recipients
                            $isChecked = in_array($item['id'], Arr::pluck($letter->recipients, 'id'));
                            @endphp
                            <input disabled class="form-check-input" type="checkbox" value="{{ $item['id'] }}" id="recipients_{{ $item['id'] }}" name="recipients[]" {{ $isChecked ? 'checked' : '' }}>
                            <label class="form-check-label" for="recipients_{{ $item['id'] }}">
                            </label>
                        </div>
                    </div>
                </td>
                @endforeach
                </tr>
        
            </tbody>
            
        </table>
          <p class="card-text">Ringkasan:</p>
          <p class="card-text">Sendirian We</p>
          {{-- <a href="#" class="btn btn-primary">download</a> --}}
        </div>
      </div>
</body>
</html>
@endsection
