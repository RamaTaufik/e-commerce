@extends('layouts.app-auth')

@section('title')
Login
@endsection

@section('content')
<a class="position-absolute top-0 start-0 mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('home') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
<h3 class="w-50 text-center text-head card-title border-bottom my-3 mx-auto">{{ __('LOG IN') }}</h3>
<div class="card-body">
    <form method="POST" action="{{ route('login') }}" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 mb-3">
                <label for="email">{{ __('Alamat Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-10 offset-md-1 mb-3">
                <label for="password">{{ __('Kata Sandi') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-10 offset-md-1 mb-2">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>
        </div>
    </form>
    <p class="m-0 p-0">
        Belum punya akun?
        <a href="{{ route('register') }}">
            {{ __('Daftar disini') }}
        </a>
    </p>
    @if (Route::has('password.request'))
        <a class="p m-0 p-0" href="{{ route('password.request') }}">
            {{ __('Lupa Kata Sandi?') }}
        </a>
    @endif
</div>
@endsection