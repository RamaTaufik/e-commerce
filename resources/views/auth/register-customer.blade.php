@extends('layouts.app-auth')

@section('title')
Sign Up
@endsection

@section('content')
<a class="position-absolute top-0 start-0 mt-1 ms-2 text-decoration-none text-secondary" href="{{ route('register') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
<h3 class="w-50 text-center text-head card-title border-bottom my-3 mx-auto">{{ __('SIGN UP') }}</h3>
<div class="card-body">
    <form action="{{ route('register') }}" class="mb-4" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 mb-3">
                <label for="email">{{ __('Alamat Email') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-5 offset-md-1 mb-3">
                <label for="Fname">{{ __('Nama Depan') }}</label>
                <input id="Fname" type="text" class="form-control @error('Fname') is-invalid @enderror" name="Fname" value="{{ old('Fname') }}" required autocomplete="Fname" autofocus>
                @error('Fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-5 mb-3">
                <label for="Lname">{{ __('Nama Belakang') }}</label>
                <input id="Lname" type="text" class="form-control @error('Lname') is-invalid @enderror" name="Lname" value="{{ old('Lname') }}" required autocomplete="Lname" autofocus>
                @error('Lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-10 offset-md-1 mb-3">
                <label>Jenis Kelamin</label>
                <div>
                    <input class="form-check-input" type="radio" name="gender" id="genderM" value="m" {{ old('gender') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="genderM">
                        Pria
                    </label>
                    <input class="form-check-input ms-2" type="radio" name="gender" id="genderW" value="w" {{ old('gender') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="genderW">
                        Wanita
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-10 offset-md-1 mb-3">
                <label for="date_of_birth">{{ __('Tanggal Lahir') }}</label>
                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus>
                @error('date_of_birth')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-10 offset-md-1 mb-3">
                <label for="phone">{{ __('Nomor Telepon') }}</label>
                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"  name="phone" value="{{ old('phone') }}" pattern="[0-9]{10,}" autocomplete="phone" autofocus>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-10 offset-md-1 mb-3">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-12 col-md-10 offset-md-1 mb-2">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        <div class="d-flex flex-column align-items-center">
            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
    <h6 class="m-0 p-0">
        Sudah punya akun?
        <a href="{{ route('login') }}">
            {{ __('Masuk disini') }}
        </a>
    </h6>
</div>
@endsection