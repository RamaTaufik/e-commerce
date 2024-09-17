@extends('layouts.app')

@section('title')
Keranjang ● Plus-H
@endsection

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <table class="table-separated">
                <tr class="rounded-pill shadow-sm bg-white position-sticky" style="top:120px;z-index:1;">
                    <th class="px-3 rounded-start-pill">
                        <input type="checkbox" name="all" id="all">
                    </th>
                    <th class="w-100 border-start"><p class="w-100 m-0 p-0 text-center">Produk</p></th>
                    <th class="border-start"><p class="m-0 p-0 px-5 text-center">Jumlah</p></th>
                    <th class="px-3 border-start rounded-end-circle">Pengiriman</th>
                </tr>
                <tr class="rounded shadow-sm bg-white">
                    <td class="px-3">
                        <input type="checkbox" name="all" id="all">
                    </td>
                    <td class="w-100 border-start p-2 d-flex justify-content-between">
                        <img src="../style/asset/image/test.png" class="object-fit-cover img-fluid" style="width:75px;aspect-ratio:1/1;" alt="">
                        <div class="d-flex flex-column justify-content-center">
                            <h5 class="text-end">Tipis-tipis abangku</h5>
                            <p class="p-0 m-0 text-end">Rp500.000,00</p>
                        </div>
                    </td>
                    <td class="border-start">
                        <h5 class="text-center">5x</h5>
                        <p class="p-0 m-0 text-center">Rp2.500.000,00</p>
                    </td>
                    <td class="border-start">
                        <select name="" id="" class="form-select border-0 bg-light">
                            <option value="jne">JNE</option>
                            <option value="ninja">Ninja Express</option>
                            <option value="jnt">JNT</option>
                            <option value="sicepat">SiCepat</option>
                        </select>
                    </td>
                </tr>
                <tr class="rounded shadow-sm bg-white">
                    <td class="px-3">
                        <input type="checkbox" name="all" id="all">
                    </td>
                    <td class="w-100 border-start p-2 d-flex justify-content-between">
                        <img src="../style/asset/image/test.png" class="object-fit-cover img-fluid" style="width:75px;aspect-ratio:1/1;" alt="">
                        <div class="d-flex flex-column justify-content-center">
                            <h5 class="text-end">Tipis-tipis abangku</h5>
                            <p class="p-0 m-0 text-end">Rp500.000,00</p>
                        </div>
                    </td>
                    <td class="border-start">
                        <h5 class="text-center">5x</h5>
                        <p class="p-0 m-0 text-center">Rp2.500.000,00</p>
                    </td>
                    <td class="border-start">
                        <select name="" id="" class="form-select border-0 bg-light">
                            <option value="jne">JNE</option>
                            <option value="ninja">Ninja Express</option>
                            <option value="jnt">JNT</option>
                            <option value="sicepat">SiCepat</option>
                        </select>
                    </td>
                </tr>
            </table>
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
