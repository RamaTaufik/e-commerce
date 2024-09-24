@extends('layouts.app-auth')

@section('title')
Sign Up
@endsection

@section('content')
<a class="position-absolute top-0 start-0 mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('home') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
<h3 class="w-50 text-center text-head card-title border-bottom my-3 mx-auto">{{ __('SIGN UP') }}</h3>
<div class="card-body">
    <form method="POST" action="{{ route('otp.request') }}" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 mb-3">
                <label for="email">{{ __('Alamat Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <input type="hidden" name="number" value="0">
        <input type="hidden" name="ver_type" value="register.customer">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Konfirmasi') }}
            </button>
        </div>
    </form>
    <p class="m-0 p-0">
        Sudah punya akun?
        <a href="{{ route('login') }}">
            {{ __('Masuk disini') }}
        </a>
    </p>
</div>
@endsection