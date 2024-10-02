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
            <div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card d-none ongkir">
                        <div class="card-body">
                            <ul class="list-group" id="ongkir"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card border-0 p-3 shadow-sm position-sticky" style="top:120px;">
                <form action="{{ route('order.buy') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="d-flex justify-content-between text-head">
                        <h4>Total</h4><h4 class="text-secondary">Rp{{number_format($total['price'],0,'.',',')}}</h4>
                    </div>
                    
                    <table class="table table-cart table-light">
                        <tr class="shadow-sm position-sticky" style="top:120px;z-index:1;">
                            <th class="px-3 rounded-start-5"></th>
                            <th class="border-start"><p class="w-100 m-0 p-0 text-center">Jenis</p></th>
                            <th class="w-100 border-start"><p class=" m-0 p-0 text-center">Harga</p></th>
                            <th class="border-start rounded-end-5"><p class="m-0 p-0 px-5 text-center">Estimasi Sampai</p></th>
                        </tr>
                        @foreach ($cost[0]['costs'] as $shipmentType)
                        <tr class="shadow align-middle">
                            <td class="px-3 rounded-start-4">
                                <input type="radio" name="shipment_type" id="{{$shipmentType['service']}}" value="{{$shipmentType['service']}}">
                            </td>
                            <td class="border-start">
                                {{$shipmentType['description']}}
                            </td>
                            <td class="border-start">
                                Rp{{number_format($shipmentType['cost'][0]['value'],0,',','.')}}
                            </td>
                            <td class="border-start">
                                {{$shipmentType['cost'][0]['etd']}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <button type="submit" class="btn btn-primary">Check Out</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('script/address.js') }}"></script>
@endsection