@extends('layouts.app-auth')

@section('title')
Verifikasi OTP
@endsection

@section('alert')
<div class="alert alert-danger">
    <h6 class="m-0 p-0">Warning</h6>
</div>
@endsection

@section('content')
<a class="position-absolute top-0 start-0 mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('register') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
<h3 class="w-50 text-center text-head card-title border-bottom my-3 mx-auto">{{ __('Verifikasi Kode OTP') }}</h3>
<div class="card-body">
    <form method="POST" action="{{ route('otp.validate') }}" class="mb-4">
        @csrf
        <div class="row mb-3">
            <div class="d-flex flex-column align-items-center">
                <div class="col-12 col-md-8">
                    <input id="otp" type="text" class="form-control mb-2"  name="otp" value="" pattern="[0-9]{6}" required autofocus>
                </div>
                <input name="email" type="hidden" value="{{$email}}">
                <input id="uniqueId" name="uniqueId" type="hidden" value="{{$otp_req['uniqueId']}}">
                <input type="hidden" name="ver_type" value="register.customer">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Kirim') }}
                    </button>
                </div>
            </div>
        </div>
        <h6 class="m-0 p-0 mb-3" id="timer">
            Kode akan kadaluarsa dalam 
            <span class="text-danger"></span>
        </h6>
        <h6 class="m-0 p-0 mb-3">
            Tidak menerima kode? 
            <span id="resend"></span>
            <a id="resend-link" href="https://fgo.gamepress.gg/servant/space-ereshkigal" style="display:none">Kirim ulang</a>
        </h6>
    </form>
</div>
@endsection

@section('script')
<script src="{{ asset('script/timer.js') }}"></script>
@endsection