@extends('layouts.template')

{{-- isi bagian yield --}}
@section('content')
    @if (Session::get('success'))
        <br>
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::get('deleted'))
        <br>
        <div class="alert alert-success">
            {{ Session::get('deleted') }}
        </div>
    @endif
    <div class="jumbotron  mt-2" style="padding:0px;">
        <div class="container">
            {{-- @if (Session::get('failed'))
          <div class="alert alert-danger">{{Session::get('failed')}}</div>
          @endif --}}
            <h3><b>Data Surat</b></h3>
            {{-- <h3>Selamat Datang </h3> --}}
            <p class="lead">Home/ <a href="#">DataSurat</a></p>
        </div>
    </div>
    <br>
    <div class="col-sm-20">
        <div class="card">
            <div class="card-body">
                <h5 class="card-text">
                    <div class="d-flex justify-content-start
">
                        <a class="nav-link btn btn-primary" style="width: 15%;margin:10px 0px -30px 0px;"
                            href="{{ route('letter.create') }}">Tambah data</a>
                        <a class="nav-link btn btn-success" style="width: 15%;margin:10px 0px -30px 20px;"
                            href="{{ route('letter.letters.downloadExcel') }}">Export Excel</a>
                    </div>
                    <div class=" justify-content-start" style="width: 60%;height:10%;">
                        <form action="{{route('guru.search')}}" class="" method="GET" style="display: flex; margin-bottom:0px;">
                            <input type="text" name="search" id="search" class="" style="width:40%;margin-top:5%;" placeholder="cari data..." >
                            <button type="submit" class="btn btn-primary " style="margin-left:5px;margin-top:5%;width:10%;">cari</button>
                            <a class="btn btn-danger ml-5" href="{{route('guru.index')}}" style="margin-left:2%;margin-top:5%;width:15%;">Reset</a>
                           </form>
                         </h5>
                         <div class=" justify-content-start mt-3" style="width: 40%;height:90%;display:flex;justify-content:end;">
                           <select name="" id="">
                             <option value="" style="width:40%;margin-top:5%;" >10</option>
                           </select>
                           <p style="margin: 0 10px">entries per page</p>
                         </div>
                </h5>
                
                <table class="table mt-5 table-striped table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            {{-- <th>password</th> --}}
                            <th>Tanggal Keluar</th>
                            <th>Penerima</th>
                            <th>Notulis</th>
                            <th>Hasil Rapat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center">
                        @php $no=1; @endphp
                        @foreach ($letters as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                {{-- <td>{{$letter_type['letter_code']/$item['letter_type_id']}}</td> --}}
                                <td>{{$no + 2}}-{{$no+1}}/000{{$item->letter_type_id}}/SMK WIKRAMA/XII/2023</td>
                                {{-- <td>{{ $item['letter_perihal'] }}</td> --}}
                                <td>{{ $item->letter_perihal }}</td>
                                @php
                                    setLocale(LC_ALL, 'id_ID');
                                @endphp
                                <td>{{ Carbon\Carbon::parse($item['created_at'])->formatLocalized('%d %B %Y') }}</td>
                                {{-- <td>{{$item['recipients']}}</td> --}}
                                <td>
                                        {{-- @foreach ($item['recipients'] as $recipient)
                                            <li>{{ $recipient['name_recipients'] }} <small>(Qty:
                                                    {{ $recipient['qty'] }})</small></li>
                                        @endforeach --}}

                                        {{-- {{
                                          implode('|',array_map(function($recipients){
                                            return is_array($recipients) ? implode(',','<ol>',$recipients,'</ol>') : $recipients;
                                          },$item->recipients
                                          ))
                                        }} --}}
                                            {{-- @foreach ($letters as $item) --}}
                                                <ol>
                                                    {{ implode('|', array_map(function($recipients){
                                                        return is_array($recipients) ? implode(',', $recipients) : $recipients;
                                                    }, $item->recipients)) }}
                                                </ol>
                                            {{-- @endforeach --}}
                                        {{-- Nested Loop : Looping didalam looping --}}
                                        {{-- karena column medicines pada table orders tipe datanya json , jadi aksesnya bitih looping --}}
                                        {{-- @foreach ($letters['recipients'] as $recipient) --}}
                                        {{-- tampilan yang ingin ditampilkan :
                          output: 1. nama_obat Rp.3.000 (qty2) --}}
                                        {{-- <li>{{$recipient['name_recipients']}} <small> --}}
                                        {{-- </small> --}}
                                        {{-- @endforeach --}}
                                        {{-- <li>
                            {{implode(',',array_column($item->recipients.'name_recipients'))}} --}}
                        </td>
                                {{-- <td>{{ $item['notulis'] }}</td> --}}
                                <td>{{ $item->user->name }}</td>
                                {{-- <td>{{ $item['attachment'] }}</td> --}}
                                <td style="padding:5px 10px"><a href="{{ route('result.create', $item['id']) }}" class="btn btn-danger" style="padding:10px 20px;">Belum  Dibuat</a>
                                </td>                                {{-- <td>{{$item['password']}}</td> --}}
                                <td class="" style="align-items: center;width:100%;">
                                    <a href="{{ route('letter.letter_detail', $item['id']) }}"
                                        class="color light-blue " style="margin-right:20px;">Lihat</a>
                                    <a href="{{ route('letter.edit', $item['id']) }}" class="btn btn-success">Edit</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" class="ms-3" style="margin: 0px 10px;">
                                        Hapus
                                    </button>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Hapus</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda ingin menghapus data ini
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Kembali</button>
                                                    
                                                <form action="{{ route('letter.delete', $item['id']) }}" method="post"
                                                    class="ms-3">
                                                    {{-- Menimpa atau mengubahj method post menjadi method DELETE sesuai dengan method route(::delete) --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                {{-- </div> --}}
                                            </div>
                                        </div>
                                    </div>

                                    </form>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
                <hr>
                <div class="d-flex justify-content-start
      ">
                    <a href="#" class="">Showing 2 to 1 of 1 entries</a>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end
">
            @if ($letters->count())
                {{ $letters->links() }}
            @endif
        </div>
        <script>
            const links = document.querySelectorAll('.btn-danger');
    
            const button = document.querySelector('a[href="{{ route('result.create', $item['id']) }}"]');
    if (button) {
        button.textContent = 'Sudah dibuat';
        button.classList.remove('btn-danger');
        button.classList.add('btn-success');
    }
        </script>
    
    @endsection
