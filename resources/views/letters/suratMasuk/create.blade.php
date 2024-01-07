@extends('layouts.template')

@section('content')
<div class="jumbotron  mt-2" style="padding:0px;">
    <div class="container">
            {{-- @if(Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif --}}
            <h3><b>Hasil Rapat</b></h3>
            {{-- <h3>Selamat Datang </h3> --}}
            <p class="lead">Home/ <a href="{{route('result.index')}}">Data surat</a>/<a href="#">Hasil Surat</a></p>
        </div>
    </div>
    <form action="{{route('result.result_data')}}" method="post" class="card  mt-5 p-5 mb-5">
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
                    <div class="form-check">
                        @php
                        // Check if the current recipient ID exists in the selected recipients
                        $isChecked = in_array($item['id'], Arr::pluck($letter->recipients, 'id'));
                        @endphp
                        <input class="form-check-input" type="checkbox" value="{{ $item['id'] }}" id="presence_recipients_{{ $item['id'] }}" name="presence_recipients[]">
                        <label class="form-check-label" for="presence_recipients_{{ $item['id'] }}">
                        </label>
                    </div>
                </div>
            </td>
            @endforeach
            </tr>
    
        </tbody>
        
    </table>
        <div class="mb-3">
            <label for="notes" class="col-sm-2 col-form-label">Ringkasan Hasil Rapat:</label>
            <div class="col-sm-10 w-100">
                <input class="form-control" id="notes" name="notes" type="hidden">
                <trix-editor input="notes"></trix-editor>
            </div>
            
        </div>
        {{-- <div class="mb-3 row">
            <label for="recipients" class="col-sm-2 col-form-label">Nama:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="recipients" name="recipients">
            </div> --}}
        {{-- </div> --}}
        {{-- <div class="mb-3 row">
            <label for="content" class="col-sm-2 col-form-label">Lampiran:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="content" name="content">
            </div>
        </div> --}}
        {{-- <div class="mb-3">
            <label for="notulis" class="col-sm-2 col-form-label">Notulis:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="notulis" name="notulis">
            </div>
        </div> --}}
        
        <div class="btn-end" style="display:flex;justify-content:end;">
        <button type="submit" class="btn btn-primary w-25" >Simpan Data</button>
    </div>
    </form>
@endsection
