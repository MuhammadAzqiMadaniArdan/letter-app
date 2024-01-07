{{-- <!DOCTYPE html>
<html lang="en"> --}}
{{-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Apotek App</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Apotek App</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              {{-- auth::check digunakna untuk mengecek apakah data sudah login atau belum jika belum maka navbar tidak akan dimunculkan --}}
              {{-- @if (Auth::check()) --}}
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">DASHBOARD</a>
              </li>
              {{-- @if (Auth::user()->role == "admin") --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Obat
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" >Data Obat</a></li>
                  <li><a class="dropdown-item" >Tambah Data</a></li>
                  <li><a class="dropdown-item" >Stock</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Data Pembelian</a>
              </li>
              {{-- @endif --}}

              {{-- @if (Auth::user()->role == "cashier") --}}
              <li class="nav-item">
                <a class="nav-link" href="">Pembelian</a>
              </li>
              {{-- @endif --}}

              </li>
              {{-- @if (Auth::user()->role == "admin") --}}
              <li class="nav-item">
                <a class="nav-link" >Kelola akun</a>
              </li>
              {{-- @endif --}}
              <li class="nav-item">
                <a class="nav-link" href="">Logout</a>
              </li>

              {{-- @endif --}}
            </ul>
          </div>
        </div>
    </nav>
    <div class="container">
        @yield('content') 
        {{-- untuk menyimpan html yg sifatnya dinamis/berubah tiap page nya --}}
        {{-- wajib diiisi ketika template dipanggil --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    {{-- mengisi js/css yg dinamis (optional) --}}
    {{-- diisi dengan push --}}
    @stack('script')
</body> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Horizontal - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="./assets/compiled/css/app.css">

</head>x  

<body>
    <script src="./js/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.html">x  </a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2" >
                                        <img src="./assets/compiled/jpg/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">John Ducky</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Member</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                  <li><a class="dropdown-item" href="#">My Account</a></li>
                                  <li><a class="dropdown-item" href="#">Settings</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="auth-login.html">Logout</a></li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            
                            
                            
                            <li
                                class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                                </a>
                            </li>
                            
                            
                            
                            <li
                                class="menu-item  has-sub">
                                <a href="#" class='menu-link'>
                                    <span><i class="bi bi-stack"></i> Components</span>
                                </a>
                              </div>
                            </div>
</html>