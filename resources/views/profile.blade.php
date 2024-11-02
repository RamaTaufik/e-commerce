@extends('layouts.app')

@section('title')
Profil ● Plus-H
@endsection

@section('content')
<div class="container p-md-5 p-2">
    <div class="row">
        <div class="col-12 col-md-3">
            <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('home') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-12 col-md-9 bg-white border rounded"></div>
    </div>
</div>
@endsection
