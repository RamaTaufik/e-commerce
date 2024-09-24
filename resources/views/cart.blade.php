@extends('layouts.app')

@section('title')
Keranjang ● Plus-H
@endsection

@section('content')
<div class="container my-4">
    <a class="mt-1 ms-2 fs-5 text-decoration-none text-secondary" href="{{ route('home') }}"><i class="fa-solid fa-circle-arrow-left"></i> Kembali</a>
    <div class="row">
        <div class="col-md-8">
            <form action="" method="post">
                @csrf
                @method('POST')
                <table class="table table-cart table-light">
                    <tr class="shadow-sm position-sticky" style="top:120px;z-index:1;">
                        <th class="px-3 rounded-start-5">
                            <input type="checkbox" name="all" id="all">
                        </th>
                        <th class="w-100 border-start"><p class="w-100 m-0 p-0 text-center">Produk</p></th>
                        <th class="border-start"><p class="m-0 p-0 px-5 text-center">Jumlah/Harga</p></th>
                        <th class="px-3 border-start rounded-end-5">Pengiriman</th>
                    </tr>
                    @if(session()->has('cart'))
                        @foreach (session('cart') as $cartItem)
                        <tr style="height:5px"></tr>
                        <tr class="shadow align-middle">
                            <td class="px-3 rounded-start-4">
                                <input type="checkbox" name="all" id="all">
                            </td>
                            <td class="border-start">
                                <div class="d-flex align-items-center justify-content-between">
                                    <img src="{{ asset('image/products/'.$cart[$cartItem['product_variant_code']]['image']) }}" class="product-img" alt="">
                                        <h5 class="text-end">{{$cart[$cartItem['product_variant_code']]['name']}}</h5>
                                </div>
                            </td>
                            <td class="border-start">
                                <h6 class="m-0 p-0 text-center">{{$cartItem['qty']}}x</h6>
                                <p class="m-0 p-0 text-center">Rp{{number_format($cart[$cartItem['product_variant_code']]['price'],0,'.',',')}}</p>
                            </td>
                            <td class="border-start rounded-end-4">
                                <select name="" id="" class="form-select border-0 bg-light">
                                    <option value="jne">JNE</option>
                                    <option value="ninja">Ninja Express</option>
                                    <option value="jnt">JNT</option>
                                    <option value="sicepat">SiCepat</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr style="height:5px;"></tr>
                    <tr>
                        <td colspan="4" class="py-5 rounded align-middle">
                            <h4 class="py-5 text-secondary text-center">
                                Oops, kamu belum menambahkan barang apapun. <br>
                                <a href="{{ route('home') }}" class="btn btn-secondary fs-4">Belanja Sekarang</a>
                            </h4>
                        </td>
                    </tr>
                    @endif
                </table>
            </form>
        </div>
        <div class="col-md-4">
            <div class="card border-0 p-3 shadow-sm position-sticky" style="top:120px;">
                <form action="">
                    <div class="d-flex justify-content-between text-head">
                        <h6>Tipis-tipis abangku</h6><h6 class="text-secondary">Rp250.000,00</h6>
                    </div>
                    <div class="d-flex justify-content-between text-head">
                        <h6>Tipis-tipis abangku</h6><h6 class="text-secondary">Rp250.000,00</h6>
                    </div>
                    <div class="d-flex justify-content-between text-head">
                        <h4>Total</h4><h4 class="text-secondary">Rp500.000,00</h4>
                    </div>
                    <select name="address" id="address" class="form-select my-2 border-0">
                        <option value="" hidden disabled selected> Pilih alamat pengiriman</option>
                        <option value="">SMKN 11 Bandung, Kec. Cijerah, Bandung Kulon, Kota Bandung</option>
                        <option value="">SMPN 1 Bandung, Kec. Cicendo, Bandung Kulon, Kota Bandung</option>
                        <option value="">Isi manual</option>
                    </select>
                    <input type="text" name="address" placeholder="Alamat" class="form-control">
                    <input type="text" name="city" placeholder="Kabupaten/Kota" class="form-control mt-2">
                    <input type="text" name="province" placeholder="Provinsi" class="form-control mt-2">
                    <select name="metode" id="metode" class="form-select my-2 border-0">
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
