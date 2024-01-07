@extends ('layouts.template')

@section('content')
<form action="{{route ('auth-login')}}" class="card p-4 mt-5" method="POST">
    @csrf
    @if ($errors->any())
            <ul class="alert alert-danger p-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{-- menampilkan session dari controller auth login yang berada pada with namanya failed --}}
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{Session::get('failed')}}</div>
        @endif
        <div class="mb-3 mx-1">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="masukkan email anda....">
        </div>
        <div class="mb-3 mx-1">
            <label for="password" class="form-label">password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="masukkan password anda....">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
    </form>
@endsection