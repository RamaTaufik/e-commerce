@extends('layouts.app')

@section('title')
Pesan ● Plus-H
@endsection

@section('content')
<div class="container my-4">
    <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('cart') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 p-3 shadow-sm position-sticky" style="top:120px;">
                <form action="">
                    @if(session()->has('cart'))
                        @foreach (session('cart') as $cartItem)
                        <div class="d-flex justify-content-between text-head">
                            <h6>{{$cart[$cartItem['product_variant_code']]['name']}}</h6>
                            <h6 class="text-secondary">Rp{{number_format($cart[$cartItem['product_variant_code']]['price'],0,'.',',')}}</h6>
                        </div>
                        @endforeach
                    <div class="d-flex justify-content-between text-head">
                        <h4>Total</h4><h4 class="text-secondary">Rp{{number_format($total,0,'.',',')}}</h4>
                    </div>
                    @endif
                    <select name="destination" id="destination" class="form-select my-2 border-0">
                        <option value="" hidden disabled selected> Pilih alamat pengiriman</option>
                        <option value="">SMKN 11 Bandung, Kec. Cijerah, Bandung Kulon, Kota Bandung</option>
                        <option value="">SMPN 1 Bandung, Kec. Cicendo, Bandung Kulon, Kota Bandung</option>
                        <option value="">Isi manual</option>
                    </select>
                    <select name="provinsi" id="province" class="form-select my-2 border-0" 
                    onchange="unlockSelectOption('province','city',{{json_encode($address['kabupaten'])}},'subdistrict',{{json_encode($address['kecamatan'])}})">
                        <option value="" hidden disabled selected> Provinsi</option>
                        @foreach ($address['provinsi'] as $province)
                        <option value="{{$province}}">{{$province}}</option>
                        @endforeach
                    </select>
                    <select name="kabupaten" id="city" class="form-select my-2 border-0" onchange="unlockSelectOption('city','subdistrict',{{json_encode($address['kecamatan'])}})" disabled>
                        <option value="" hidden disabled selected> Kabupaten</option>
                    </select>
                    <select name="kecamatan" id="subdistrict" class="form-select my-2 border-0" disabled>
                        <option value="" hidden disabled selected> Kecamatan</option>
                    </select>
                    <textarea name="address" placeholder="Alamat" class="form-control"></textarea>
                    <select name="metode" id="payment_method" class="form-select my-2 border-0">
                        <option value="" hidden disabled selected> Pilih metode pembayaran</option>
                        <option value="">Transfer bank</option>
                        <option value="">OVO</option>
                        <option value="">GoPay</option>
                        <option value="">CoD</option>
                    </select>
                    <a class="btn btn-primary w-100" href="/customer/tracking">Pesan</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('script/address.js') }}"></script>
@endsection