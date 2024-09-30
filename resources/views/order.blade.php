@extends('layouts.app')

@section('title')
Pesan ● Plus-H
@endsection

@section('content')
<div class="container my-4">
    <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('cart') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
    <div class="row">
        <div class="col-12 col-md-6 h-100 overflow-y">
            <table class="table align-middle">
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Harga x Jumlah Beli</th>
                </tr>
                @foreach ($cart as $cartItem)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{$cartItem['name']}}<br>
                        @if ($cartItem['color']!=NULL)
                        {{$cartItem['size']}} | {{$cartItem['color']}}
                        @endif
                    </td>
                    <td>Rp{{number_format($cartItem['price'],0,'.',',')}} x {{$cartItem['qty']}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border-0 p-3 shadow-sm position-sticky" style="top:120px;">
                <form action="{{ route('order.buy') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="d-flex justify-content-between text-head">
                        <h4>Total</h4><h4 class="text-secondary">Rp{{number_format($total,0,'.',',')}}</h4>
                    </div>
                    <select name="myAddress" id="myAddress" class="form-select my-2 border-0">
                        <option value="" hidden disabled selected> Pilih alamat pengiriman</option>
                        @foreach ($myAddresses as $myAddress)
                        <option value="{{$myAddress->id}}">{{$myAddress->address_detail}}</option>
                        @endforeach
                        <option value="new">Alamat Baru</option>
                    </select>
                    <input class="form-control mb-2" list="provinceList" name="provinsi" id="province" placeholder="Provinsi"
                     onchange="unlockDatalistOption('province','city',{{json_encode($address['kabupaten'])}},'subdistrict',{{json_encode($address['kecamatan'])}})">
                    <datalist id="provinceList">
                        @foreach ($address['provinsi'] as $province)
                        <option value="{{$province}}">{{$province}}</option>
                        @endforeach
                    </datalist>
                    <input class="form-control mb-2" list="cityList" name="kabupaten" id="city" placeholder="Kabupaten"
                     onchange="unlockDatalistOption('city','subdistrict',{{json_encode($address['kecamatan'])}})" disabled>
                    <datalist id="cityList"></datalist>
                    <input class="form-control mb-2" list="subdistrictList" name="kelurahan" id="subdistrict" placeholder="kelurahan" disabled>
                    <datalist id="subdistrictList"></datalist>
                    <textarea name="address_detail" placeholder="Detail alamat" class="form-control mb-2"></textarea>
                    <select name="shipment_id" class="form-select mb-3 border-0">
                        <option value="" hidden disabled selected> Pilih pengiriman</option>
                        @foreach ($shipments as $shipment)
                        <option value="{{$shipment->id}}">{{$shipment->shipmen_name}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="total_price" value="{{$total}}">
                    <button type="submit" class="btn btn-primary">Pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('script/address.js') }}"></script>
@endsection