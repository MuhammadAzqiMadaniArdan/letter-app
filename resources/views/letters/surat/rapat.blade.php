<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pembelian</title>
    <style>
        /* Kode CSS Responsif */
        body {
            font-size: 16px;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        /* Penyesuaian lebar maksimum */
        #receipt {
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30px auto;
            max-width: 900px; /* Lebar maksimum */
            background: #FFF;
            margin-bottom: 40px;
            width: 90%; /* Penyesuaian lebar */
        }

        /* Penyesuaian gambar */
        .logo img{
            max-width: 100%;
            width: 100px;
            height: auto;        }

        /* Penyesuaian Teks */
        p, h3 {
            font-size: 1rem; /* Ukuran font */
        }
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
        /* Rata kanan untuk elemen teks */
        .text-right {
            text-align: right;
        }

        /* Ruang atas */
        .mt-25 {
            margin-top: 25px;
        }

        /* Fleksibilitas tata letak */
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        /* Penyesuaian elemen info */
        .info {
            width: 100%;
            margin: 20px 0;
        }

        /* Responsive untuk bagian tengah */
        .mid-content {
            width: 100%;
            margin: 0 20px;
        }
    </style>
</head>
<body>
    <div class="flex" style="margin: 0 100px">
        <div>
            <a href="{{ route('letter.index') }}" class="btn-back">Kembali</a>
        </div>
        <div>
            <a href="{{ route('letter.download-pdf', $letter['id']) }}" class="btn-print btn-back">Cetak (.pdf)</a>
        </div>
    </div>
    <div id="receipt">
        <hr>
        <div class="info flex">
            <div class="logo">
                <img src="https://smkwikrama.sch.id/assets2/wikrama-logo.png" alt="Wikrama Logo">
            </div>
            <div>
                <h3>SMK WIKRAMA BOGOR</h3>
                <p>Manajemen dan Bisnis <br> Teknik Informasi dan Komunikasi <br> Pemasaran</p>
            </div>
            <div class="text-right">
                <p>Jl.Raya Wangun Ke.SindangSari BOGOR <br> Telp/Faks : 02518242411 <br> e-mail: prohumasi@smkwikrama.sch.id <br> Website: www.smkwikrama.sch.id</p>
            </div>
        </div>
        <hr>
        <div class="mid-content">
            <div class="text-right mt-25">
                @php
                    setLocale(LC_TIME, 'id_ID');
                @endphp
                <p style="font-weight: 200">{{ Carbon\Carbon::parse($letter['created_at'])->formatLocalized('%d %B %Y') }}</p>
            </div>
            <div class="flex">
                @php
                $no = 1;
                @endphp
                <div style="width: 50%;">
                    <p>No: {{$no + 2}}-{{$no+1}}/000{{$letter->letter_type_id}}/SMK WIKRAMA/XII/2023<br> Hal: <b>{{ $letter['letter_perihal'] }}</b></p>
                </div>
                <div style="width: 50%;">
                    <p>Kepada <br> Yth.Bapak/Ibu Terlampir <br> di <br> Tempat</p>
                </div>
            </div>
            <div class="mt-25">
                <p>
                @php
                      $content = strip_tags($letter->content);
                      @endphp
                      {{$content}}
                    </p>
                <br>
                <p>Peserta:</p>
                {{-- <p>{{ $letter['notulis'] }}</p> --}}
                                <p>{{ $letter->user->name }}</p>

            </div>
        </div>
        <hr>
        <div class="text-right">
            <p>Hormat Kami, <br> Kepala SMK Wikrama Bogor</p>
            <p style="margin-top: 10%; margin-left: 30%;">(...........................)</p>
        </div>
    </div>
</body>
</html>
