<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TataUsaha App</title>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="./js/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"></script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

        :root {
            --header-height: 3rem;
            --nav-width: 198px;
            --first-color: #4723D9;
            --first-color-light: #AFA5D9;
            --white-color: #F7F6FB;
            --body-font: 'Nunito', sans-serif;
            --normal-font-size: 1rem;
            --z-fixed: 100
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box
        }

        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s
        }

        a {
            text-decoration: none
        }

        .header {
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            background-color: var(--white-color);
            z-index: var(--z-fixed);
            transition: .5s
        }

        .header_toggle {
            color: var(--first-color);
            font-size: 1.5rem;
            cursor: pointer
        }

        .header_img {
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden
        }

        .header_img img {
            width: 40px
        }

        .l-navbar {
            position: fixed;
            top: 0;
            left: -30%;
            width: var(--nav-width);
            height: 100vh;
            background-color: var(--first-color);
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed)
        }

        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden
        }

        .nav_logo,
        .nav_link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem
        }

        .nav_logo {
            margin-bottom: 2rem
        }

        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color)
        }

        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700
        }

        .nav_link {
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s
        }

        .nav_link:hover {
            color: var(--white-color)
        }

        .nav_icon {
            font-size: 1.25rem
        }

        .show {
            left: 0
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem)
        }

        .active {
            color: var(--white-color)
        }

        .active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color)
        }

        .height-100 {
            height: 100vh
        }

        @media screen and (min-width: 768px) {
            body {
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem)
            }

            .header {
                height: calc(var(--header-height) + 1rem);
                padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
            }

            .header_img {
                width: 40px;
                height: 40px
            }

            .header_img img {
                width: 45px
            }

            .l-navbar {
                left: 0;
                padding: 1rem 1rem 0 0
            }

            .show {
                width: calc(var(--nav-width) + 156px)
            }

            .body-pd {
                padding-left: calc(var(--nav-width) + 188px)
            }
        }
  body{
        background: linear-gradient(135deg,rgb(202, 202, 255),white);
      }
    </style>
</head>

<body id="body-pd">
    {{-- <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt="">olp </div>
    </header> --}}
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
          @if (Auth::check())

            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span
                        class="nav_logo-name">Tata Usaha App</span> </a>
                <div class="nav_list"> <a href="/dashboard" class="nav_link active"> <i
                            class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                            @if (Auth::user()->role == "staff")
                            {{-- <label for="role" class="col-sm-2 col-form-label">role :</label> --}}
                            {{-- <li class="nav-item dropdown" >
                              <a class="nav-link dropdown-toggle" class="bx bx-grid-alt nav_icon" style="padding:0px 20px;background-color:#4723D9;color:white;"href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Obat
                              </a>
                              <ul class="dropdown-menu" class="bx bx-grid-alt nav_icon" style="padding:0px 20px;background-color:#4723D9;color:white;">
                                <li><a class="dropdown-item" href="{{ route('user.data') }}">Data Obat</a></li>
                                <li><a class="dropdown-item" href="{{route('guru.index')}}">Tambah Data</a></li>
                              </ul>
                            </li> --}}
                            {{-- <div class="bx bx-grid-alt nav_icon" style="padding:0px 20px;background-color:#4723D9;">
                              <select id="role" class="form-control" name="role" style="background-color:#4723D9;color:white;te">
                                  <option disabled hidden selected><span class="nav_name">Data User</span></option>
                                  <option><a href="" class="nav_link">
                                    <i class='bx bx-user nav_icon'></i> 
                                   <span class="nav_name">Data Staff Tata Usaha</span>
                                      </a></option>
                                  <option><a href="#" class="nav_link">
                                    <i class='bx bx-user nav_icon'></i> 
                                   <span class="nav_name">Data Guru</span>
                                      </a></option>
                              </select>
                          </div> --}}
                          {{-- <div class="bx bx-grid-alt nav_icon" style="padding:30px 20px 0px 20px;background-color:#4723D9;">
                            <select id="role" class="form-control" name="role" style="background-color:#4723D9;color:white;">
                              <option disabled hidden selected><span class="nav_name">Data Surat</span></option>
                              <option><a href="#" class="nav_link">
                                    <i class='bx bx-user nav_icon'></i> 
                                   <span class="nav_name">Data Klasifikasi Surat</span>
                                      </a></option>
                                      <option><a href="#" class="nav_link">
                                        <i class='bx bx-user nav_icon'></i> 
                                        <span class="nav_name">Data Surat</span>
                                      </a></option>
                                    </select>
                                  </div> --}}
                                  <a href="{{ route('user.data') }}" class="nav_link" style="padding:0px 5px 0px 0px;width:20px;">
                                    <i class='bx bx-user nav_icon'></i> 
                                   <span class="nav_name">Data Staff Tata Usaha</span>
                                      </a>
                                  <a href="{{ route('guru.index') }}" class="nav_link">
                                    <i class='bx bx-user nav_icon'></i> 
                                   <span class="nav_name" style="padding:0px 0px 0px 18px;">Data Guru</span>
                                      </a>
                                  <a href="{{ route('letter_type.index') }}" class="nav_link" style="padding:0px 2px 0px 0px;">
                                    <i class='bx bx-user nav_icon'></i> 
                                   <span class="nav_name">Data Klasifikasi Surat</span>
                                      </a>
                                  <a href="{{ route('letter.index') }}" class="nav_link" style="padding:0px 0px 0px 40px;">
                                    <i class='bx bx-user nav_icon'></i> 
                                   <span class="nav_name">Data Surat</span>
                                      </a>
                          @endif
                          @if (Auth::user()->role == "guru")
                            <a href="{{ route('result.index') }}" class="nav_link">
                         <i class='bx bx-user nav_icon'></i> 
                        <span class="nav_name">Data Surat Masuk</span>
                           </a>
                           @endif

                            {{-- <a href="#" class="nav_link"> <i
                            class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span>
                    </a> <a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span
                            class="nav_name">Bookmark</span> </a> <a href="#" class="nav_link"> <i
                            class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> <a
                        href="#" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span
                            class="nav_name">Stats</span> </a>  --}}
                          </div>
            </div> 
            <a href="{{route('auth-logout')}}" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span> </a>
          @endif
        </nav>
    </div>
    <!--Container Main start-->
    {{-- <div class="height-100 bg-light"> --}}
    <div class="container">
        @yield('content')
        {{-- untuk menyimpan html yg sifatnya dinamis/berubah tiap page nya --}}
        {{-- wajib diiisi ketika template dipanggil --}}
        {{-- </div> --}}
        <!--Container Main end-->

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
        </script>
        <script src="./js/dashboard.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"></script>


        {{-- mengisi js/css yg dinamis (optional) --}}
        {{-- diisi dengan push --}}

</html>
