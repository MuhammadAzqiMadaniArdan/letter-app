@extends ('layouts.template')

@section('content')
<style>
  img{
    width: 50px;
  }
  .card-flex{
    width: 12%;
    display: flex;
    justify-content: space-between;
  }
  .card-text{
    font:bold;
    font: medium;
    font-size: 30px;
  }
</style>
<div class="jumbotron  mt-2" style="padding:0px;">
  <div class="container">
          @if(Session::get('failed'))
          <div class="alert alert-danger">{{Session::get('failed')}}</div>
          @endif
          {{-- jika berhasil munculkan notifnya : --}}
        @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>            
    @endif
          <h3><b>Dashboard</b></h3>
          {{-- <h3>Selamat Datang </h3> --}}
          <p class="lead">Home/ <a href="#">Dashboard</a></p>
      </div>
  </div>
  @if (Auth::user()->role == "staff")
    <div class="row mt-3">
        <div class="col-sm-6 w-75 ">
          <div class="card ">
            <div class="card-body">
              <h5 class="card-title">Surat Keluar</h5>
              <div class="card-flex">
              <img src="https://corporacionelsol.com/wp-content/uploads/2020/06/icon-newspaper.png" alt="" srcset="">
              <p class="card-text">{{$surat}}</p>
            </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 w-25">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Klasifikasi Surat</h5>
              <div class="card-flex">
                <img src="https://corporacionelsol.com/wp-content/uploads/2020/06/icon-newspaper.png" alt="" srcset="">
              <p class="card-text" style="margin-left: 20px;">{{$klasifikasi}}</p>
            </div>
            </div>
          </div>
        </div>
      </div>
    <div class="row mt-3">
        <div class="col-sm-6 w-25">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Staff Tata Usaha</h5>
              <div class="card-flex">
              <img src="https://d3n8a8pro7vhmx.cloudfront.net/themes/5db7bca4c29480c061890f10/attachments/original/1553643295/login.png?1553643295" alt="" srcset="">
              {{-- <p class="card-text">{{$letter_types['name_type']}}</p> --}}
              <p class="card-text" style="margin-left: 20px;">{{$users}}</p>
            </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 w-75">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Guru</h5>
              <div class="card-flex">
                <img src="https://d3n8a8pro7vhmx.cloudfront.net/themes/5db7bca4c29480c061890f10/attachments/original/1553643295/login.png?1553643295" alt="" srcset="">
              <p class="card-text">{{$guru}}</p>
            </div>
            </div>
          </div>
        </div>
      </div>
      @endif
      @if (Auth::user()->role == "guru")
      <div class="row mt-3">
        <div class="col-sm-6 w-50 ">
          <div class="card ">
            <div class="card-body">
              <h5 class="card-title">Surat Masuk</h5>
              <div class="card-flex">
                <img src="https://corporacionelsol.com/wp-content/uploads/2020/06/icon-newspaper.png" alt="" srcset="">
              <p class="card-text" style="margin-left: 20px;">{{$surat}}</p>
            </div>
            </div>
          </div>
        </div>
        @endif
        
@endsection