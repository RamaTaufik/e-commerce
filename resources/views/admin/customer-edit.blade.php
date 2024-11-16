@extends('layouts.app-admin', ['page' => 'customers'])

@section('title')
Edit "{{$customer->first_name}}" ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Customers / Edit</h6>
<h1>Edit Customer</h1>
<div class="container fluid">
    <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('admin.customers') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
    <div class="container-fluid py-2 border">
        <form action="{{ route('admin.customers-update', $customer->id) }}" method="POST" class="mb-3">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-12 col-md-10 offset-md-1 mb-3">
                    <label for="email">{{ __('Alamat Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $customer->user->email }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 col-md-5 offset-md-1 mb-3">
                    <label for="first_name">{{ __('Nama Depan') }}</label>
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $customer->first_name }}" required autocomplete="first_name" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 col-md-5 mb-3">
                    <label for="last_name">{{ __('Nama Belakang') }}</label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $customer->last_name }}" required autocomplete="last_name" autofocus>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 col-md-10 offset-md-1 mb-3">
                    <label>Jenis Kelamin</label>
                    <div>
                        <input class="form-check-input" type="radio" name="gender" id="genderM" value="m" {{ $customer->gender == 'm' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="genderM">
                            Pria
                        </label>
                        <input class="form-check-input ms-2" type="radio" name="gender" id="genderW" value="w" {{ $customer->gender == 'w' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="genderW">
                            Wanita
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-10 offset-md-1 mb-3">
                    <label for="date_of_birth">{{ __('Tanggal Lahir') }}</label>
                    <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ $customer->date_of_birth }}" required autocomplete="date_of_birth" autofocus>
                    @error('date_of_birth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-12 col-md-10 offset-md-1 mb-3">
                    <label for="phone">{{ __('Nomor Telepon') }}</label>
                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror"  name="phone" value="{{ $customer->phone }}" pattern="[0-9]{10,}" autocomplete="phone" autofocus>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>
    </div>
</div>
@endsection