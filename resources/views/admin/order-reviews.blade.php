@extends('layouts.app-admin', ['page' => 'order.review'])

@section('title')
Ulasan ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Review</h6>
<h1>Ulasan</h1>
<div class="container fluid">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order') }}">Kelola Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order-shipment') }}">Status Pengiriman</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.order-cancelled') }}">Pembatalan Pesanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">Ulasan Pembeli</a>
        </li>
    </ul>
    <div class="container-fluid pt-2 border border-top-0">
        <form action="{{ route('admin.order-reviews') }}">
            <div class="row">
                {{-- <div class="col-3">
                    <label for="search">Filter</label>
                </div> --}}
                <div class="col-3">
                    <label for="search">Dari Tanggal</label>
                </div>
                <div class="col-3">
                    <label for="pagination">Pagination</label>
                </div>
                <div class="col-6"></div>
                {{-- <div class="col-3">
                    <input type="text" name="search" id="search" class="form-control" value="{{$request->input('search') ?? ''}}" placeholder="Cari nama">
                </div> --}}
                <div class="col-3">
                    <input type="date" name="from" id="from" class="form-control" value="{{$request->input('date') ?? ''}}">
                </div>
                <div class="col-3">
                    <select name="pagination" id="pagination" class="form-select">
                        <option value="20" {{$request->input('pagination') == '20' ? 'selected': ''}}>20</option>
                        <option value="50" {{$request->input('pagination') == '50' ? 'selected': ''}}>50</option>
                        <option value="100" {{$request->input('pagination') == '100' ? 'selected': ''}}>100</option>
                    </select>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </div>
            </div>
        </form>
        <table class="table">
            <thead class="align-middle">
                <tr>
                    <th>No.</th>
                    <th>Produk</th>
                    <th>Review</th>
                    <th>Rating</th>
                    <th>Foto</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$review->orderItem->productVariant->product->name}}</td>
                    <td>{{$review->customer_review}}</td>
                    <td>{{$review->rating}}</td>
                    <td><img src="{{asset('image/reviews/'.$review->picture)}}" alt="" class="img-fluid" style="max-width:250px;"></td>
                    <td>{{$review->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection