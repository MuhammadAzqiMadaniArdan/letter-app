@extends('layouts.template')

{{-- isi bagian yield --}}
@section('content')
@if (Session::get('success'))
<br>
<div class="alert alert-success">
    {{Session::get('success')}}
</div>
@endif
@if (Session::get('deleted')
)
<br>
<div class="alert alert-success">
    {{Session::get('deleted')}}
</div>
@endif
<div class="jumbotron  mt-2" style="padding:0px;">
  <div class="container">
          {{-- @if(Session::get('failed'))
          <div class="alert alert-danger">{{Session::get('failed')}}</div>
          @endif --}}
          <h3><b>Data Klasifikasi Surat</b></h3>
          {{-- <h3>Selamat Datang </h3> --}}
          <p class="lead">Home/ <a href="#">DataKlasifikasiSurat</a></p>
      </div>
  </div>
<br>
<div class="col-sm-20">
  <div class="card">
    <div class="card-body">
      <h5 class="card-text"> 
        <div class="d-flex justify-content-start
">
             <a class="nav-link btn btn-primary" style="width: 15%;margin:10px 0px -30px 0px;" href="{{route('letter_type.create')}}">Tambah data</a>
             <a class="nav-link btn btn-success" style="width: 15%;margin:10px 0px -30px 20px;" href="{{route('staff.letter_type.downloadExcel')}}">Export Excel</a>
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
            <table class="table mt-3 table-striped table-bordered table-hovered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Surat</th>
                        <th>Klasifikasi Surat</th>
                        {{-- <th>password</th> --}}
                        <th>Surat Tertaut</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no=1; @endphp 
                    @foreach ($letter_types as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item['letter_code']}}</td>
                        <td>{{$item['name_type']}}</td>
                        {{-- <td>{{$item['password']}}</td> --}}
                        <td>{{$no*1-4+2}}</td>
                        <td class="d-flex">
                            <a href="{{route('letter_type.letter_detail', $item['id'])}}" class="color light-blue col-2 ">Lihat</a>
                            <a href="{{route('letter_type.edit', $item['id'])}}" class="btn btn-success">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" class="ms-3" style="margin: 0px 10px;">
                              Hapus
                            </button>
                          </td>
                          <!-- Modal -->
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Form Hapus</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Apakah anda ingin menghapus data ini
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                              <form action="{{route('letter_type.delete', $item['id'])}}" method="post" class="ms-3">
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
      <a href="#" class="">Showing 4 to 1 of 1 entries</a>
    </div>
  </div>
</div>

<div class="d-flex justify-content-end
">
@if ($letter_types->count())
{{$letter_types->links()}}
@endif
</div>

@endsection