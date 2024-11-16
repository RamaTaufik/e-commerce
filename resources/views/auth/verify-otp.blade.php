@extends('layouts.app-auth')

@section('title')
Verifikasi OTP
@endsection

@section('alert')
@if (session('error'))
<div class="alert alert-danger">
    <h6 class="m-0 p-0">{{session('error')['resp'][session('error')['validate']['code']]}}</h6>
</div>
@endif
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
    </form>
    <h6 class="m-0 p-0 mb-3" id="timer">
        Kode akan kadaluarsa dalam
        <span class="text-danger"></span>
    </h6>
    <h6 class="m-0 p-0 mb-3">
        Tidak menerima kode?
        <span id="resend"></span>
        <form action="{{ route('otp.resend') }}" method="post">
            @csrf
            @method('POST')
            <input name="email" type="hidden" value="{{$email}}">
            <input id="uniqueId" name="uniqueId" type="hidden" value="{{$otp_req['uniqueId']}}">
            <input type="hidden" name="ver_type" value="register.customer">
            <button type="submit" id="resend-link" class="btn btn-link" style="display:none" disabled>Kirim ulang</button>
        </form>
    </h6>
</div>
@endsection

@section('script')
<script src="{{ asset('script/timer.js') }}"></script>
@endsection
