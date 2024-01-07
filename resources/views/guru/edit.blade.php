@extends('layouts.template')

@section('content')
<div class="jumbotron  mt-2" style="padding:0px;">
    <div class="container">
            {{-- @if(Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif --}}
            <h3><b>Edit Data Guru</b></h3>
            {{-- <h3>Selamat Datang </h3> --}}
            <p class="lead">Home/ <a href="{{route('guru.index')}}">DataGuru</a>/<a href="#">EditGuru</a></p>
        </div>
    </div>
    <form action="{{route('guru.update', $user ['id'])}}" method="post" class="card bg-light mt-5 p-5">
        {{--sebagai-token-akses-database --}}
        @csrf
        {{-- jika terjadi error di validasi, akan ditampilkan bagian error nya : --}}
        @method('PATCH')
        {{-- menimpa method post agar berubah menjadi patch --}}
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
            <label for="name" class="col-sm-2 col-form-label">Nama Staff :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{$user['name']}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" name="email" value="{{$user['email']}}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Ubah Password:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
@endsection
