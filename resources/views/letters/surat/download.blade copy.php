<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembelian</title>
    <style>
        #back-wrap {
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
        }
        .cnt{
            width: 100%;

        }
        #receipt {
            /* background-image: url(.././img/wikrama-letter.png); */
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30px auto 0 auto;
            width: 700px;
            /* margin: 40px; */
            background: #FFF;
            margin-bottom: 40px
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
    <div class="cnt">
    <div class="wrap" style="width: 30%">
    <div id="back-wrap">
        <a href="{{ route('letter.index') }}" class="btn">Kembali</a>

    </div>
    <a href="{{route('letter.download-pdf',$letter['id'])}}" class="btn-print">Cetak (.pdf)</a>
</div>
<div class="cnt2" style="width:50%;display:flex;justify-content:center;margin-left:25%">
    <div id="receipt" style="width: 100%">
        <div id="top" style="width: 100%">
            <div class="info"style="width: 100%">
                <div class="T1" style="width: 30%">
                {{-- <img src={{ asset('img/wikrama-letter.png') }} style="800px">  --}}
                <img src="https://smkwikrama.sch.id/assets2/wikrama-logo.png" alt="" style="width: 100px">
            </div>
                <div class="T2"style="width: 40%">
                <h3>SMK WIKRAMA BOGOR
                </h3><hr>
                <p>Managemen dan Bisnis </br>
                    Teknik Informasi dan Komunikasi</br>
                    Pemasaran
                </p>
            </div>
                <div class="address"style="width: 30%">
                    <p style="width: 10px">Jl.Raya Wangun Ke.SindangSari BOGOR </br>
                    Telp/Faks : 02518242411 </br>
                    e-mail:prohumasi@smkwikrama.sch.id</br>
                    Website:www.smkwikrama.sch.id
                    </p>
                </div>
            </div>
            <strong><hr style="border: none; height: 2px; background-color: black;">
            </strong>
        </div>
        <div id="mid"style="width: 100%">
            <div class="C1"style="width: 100%">
                @php
                // setLocale(LC_ALL, 'id_ID');
                setLocale(LC_TIME, 'id_ID');
                @endphp
                <p style="font-weight: 200">{{ Carbon\Carbon::parse($letter['created_at'])->formatLocalized('%d %B %Y') }}</p>
            </div>
            <div class="C2" style="width: 100%">
                <div class="Card1" style="width: 50%">
                    <p>No: {{$letter['letter_type_id']}}</br>
                    Hal: <b>{{$letter['letter_perihal']}} </b></p>
                </div>
                <div class="Card2"style="width: 50%">
                    <p>Kepada</p>
                    <p>Yth.Bapak/Ibu Terlampir</br>
                        di</br>
                        Tempat
                    </p>
                </div>
            </div>
            <div class="info" style="width:70%">
                <p>
                    Assalamualaikum Wr.Wb. </br>
                    Sehubungan dengan dilaksanakannya Kegiatan <b>
                        {{$letter['letter_perihal']}} </b> maka dengan ini kami mengundang seluruh Bapak/Ibu Guru & Laboran untuk hadir pada upacara rapat yang akan dilaksanakan pada : </br>
                    Hari, Tanggal : {{ Carbon\Carbon::parse($letter['created_at'])->formatLocalized('%A, %d %B %Y') }} </br>
                    Waktu: 16.00 - Selesai </br>
                    Tempat : WorkShop wikrama Guru </br>
                    Agenda : 1.Laporan KBM Reguler </br>
                    2.Penyusunan Waktu Kegiatan PAS tiap Mapel </br>
                    <br>
                    Demikian undangan ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terimakasih. </br>
                    Wassalamualaikum Wr. Wb
                </p>
                {{-- <p>
                @php
                      $content = strip_tags($letter->content);
                      @endphp
                      {{$content}}
                    </p> --}}
                <br>
                <p>
                    Peserta :
                </p>
                {{-- <p>1</p> --}}
                <p>{{$letter['notulis']}}</p>
                {{-- <td>{{ $letters->user->name }}</td> --}}
            </div>

        </div>
        <div id="foot"style="width: 100%">
            <p>Hormat Kami,</br>
            Kepala SMK Wikrama Bogor</p>
            <p style="margin-top: 10%;margin-left:30px;">(...........................)</p>
        </div>
    </div>
    </div>
</div>

</body>
</html>
