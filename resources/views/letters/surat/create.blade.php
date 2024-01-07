@extends('layouts.template')

@section('content')
<div class="jumbotron  mt-2" style="padding:0px;">
    <div class="container">
            {{-- @if(Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif --}}
            <h3><b>Tambah Data Surat</b></h3>
            {{-- <h3>Selamat Datang </h3> --}}
            <p class="lead">Home/ <a href="{{route('letter.index')}}">Datasurat</a>/<a href="#">Tambah Surat</a></p>
        </div>
    </div>
    <form action="{{route('letter.letter_data')}}" method="POST" class="card  mt-5 p-5 mb-5" enctype="multipart/form-data">
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
        <div class="flex" style="display:flex;justify-content:space-around">
        <div class="mb-3" style="width: 100%">
            <label for="letter_perihal" style="width:50%;"class="col-sm-1 col-form-label">Perihal :</label>
            <div class="col-sm-10">
                <input  type="text" class="form-control" id="letter_perihal" name="letter_perihal">
            </div>
        </div>
        <div class="mb-3" style="width: 100%;margin-left:30px;">
            <label style="width:50%;"for="name_type" class="col-sm-2 col-form-label">Klasifikasi Surat:</label>
            <div class="col-sm-10">
                <select  id="name_type" class="form-control" name="name_type">
                    <option disabled hidden selected>Pilih</option>
                    @foreach ($letters as $letter)
                <option value="{{$letter['id']}}">{{$letter['name_type']}}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
        <div class="mb-3">
            <label for="content" class="col-sm-2 col-form-label">Isi Surat:</label>
            <div class="col-sm-10">
                <input class="form-control" id="content" name="content" type="hidden">
                <trix-editor input="content" class="trix-content"></trix-editor>
            </div>
            
        </div>
        <table class="table mt-5 table-bordered table-hovered ">
            <thead>
                <tr>
    
                    <th>Nama</th>
                    <th>Peserta (Ceklis jika "iya")</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gurus as $item)
                <tr>
                    <td>{{$item['name']}}</td>
                    {{-- <td>
                        <div class="col-sm-10">
                                                tak dipake <input type="text" class="form-control" id="recipients" name="recipients">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$item['name']}}" id="recipients" name="recipients[]">
                            <label class="form-check-label" for="recipients">
                            </label>
                          </div>
                     </div>
                    </td> --}}
                    <td>
                        <div class="col-sm-10">
                        {{-- <input type="text" class="form-control" id="recipients" name="recipients"> --}}
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $item['id'] }}" id="recipients_{{ $item['id'] }}" name="recipients[]">
                            <label class="form-check-label" for="recipients_{{ $item['id'] }}">
                                {{ $item['name'] }}
                            </label>
                        </div>
                     </div>
                    </td>
                </tr>
                @endforeach
        
            </tbody>
            
        </table>
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
        <div class="mb-3">
            <label for="image" class="col-sm-2 col-form-label">Upload Image:</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image" name="image">
            </div>
        </div>
        <div class="mb-3" >
            <label style="width:50%;"for="notulis" class="col-sm-2 col-form-label">Notulis:</label>
            <div class="col-sm-10">
                <select type="text"  id="notulis" class="form-control" name="notulis">
                    <option disabled hidden selected>Pilih</option>
                    @foreach ($gurus as $guru)
                {{-- <option value="{{$guru['name']}}">{{$guru['name']}}</option> --}}
                <option value="{{$guru->id}}">{{$guru->name}}</option>
                @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data</button>
    </form>
@endsection
