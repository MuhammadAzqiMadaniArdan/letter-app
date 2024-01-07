@extends('layouts.template')

@section('content')
<div class="jumbotron  mt-2" style="padding:0px;">
    <div class="container">
            {{-- @if(Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif --}}
            <h3><b>Tambah Data Klasifikasi Surat</b></h3>
            {{-- <h3>Selamat Datang </h3> --}}
            <p class="lead">Home/ <a href="{{route('letter_type.index')}}">DataKlasifikasiSurat</a>/<a href="#">TambahKlasifikasiSurat</a></p>
        </div>
    </div>
    <form action="{{route('letter_type.letter_type_data')}}" method="post" class="card bg-light mt-5 p-5">
        {{--sebagai-token-akses-database --}}
        @csrf
        {{-- jika terjadi error di validasi, akan ditampilkan bagian error nya : --}}
        @if ($errors->any())
            <ul class="alert alert-danger p-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{-- jika berhasil munculkan notifnya : --}}
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>            
        @endif
        <div class="mb-3 row">
            <label for="letter_code" class="col-sm-2 col-form-label">Kode Surat :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="letter_code" name="letter_code">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name_type" class="col-sm-2 col-form-label">Klasifikasi Surat:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name_type" name="name_type">
            </div>
        </div>
        

        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
@endsection
