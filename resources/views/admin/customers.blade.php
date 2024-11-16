@extends('layouts.app-admin', ['page' => 'customers'])

@section('title')
Kelola Customer ● Plus-H ADMIN
@endsection

@section('content')
<h6 class="mb-0 pb-0">Admin / Customers</h6>
<h1>Kelola Customer</h1>
<div class="container fluid">
    <div class="container-fluid pt-2 border">
        <form action="{{ route('admin.customers') }}">
            <div class="row">
                <div class="col-3">
                    <label for="search">Filter</label>
                </div>
                <div class="col-3">
                    <label for="sort">Urutkan</label>
                </div>
                <div class="col-3">
                    <label for="pagination">Pagination</label>
                </div>
                <div class="col-3"></div>
                <div class="col-3">
                    <input type="text" name="search" id="search" class="form-control" value="{{$request->input('search') ?? ''}}" placeholder="Cari nama">
                </div>
                <div class="col-3">
                    <select name="sort" id="sort" class="form-select">
                        <option value="terlama" {{$request->input('sort') == 'terlama' ? 'selected': ''}}>Terlama</option>
                        <option value="terbaru" {{$request->input('sort') == 'terbaru' ? 'selected': ''}}>Terbaru</option>
                    </select>
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
                    <th>Id</th>
                    <th>Nama Depan</th>
                    <th>Nama Belakang</th>
                    <th>Email</th>
                    <th>Tanggal Verifikasi Email</th>
                    <th>Telepon</th>
                    <th>JK</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->first_name}}</td>
                    <td>{{$customer->last_name}}</td>
                    <td>{{$customer->user->email}}</td>
                    <td>{{$customer->user->email_verified_at}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->gender == 'm'? 'Laki-laki' : 'Perempuan'}}</td>
                    <td>{{$customer->date_of_birth}}</td>
                    <td>
                        <form action="{{ route('admin.customers-delete', $customer->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-warning p-0 px-2" href="{{ route('admin.customers-edit', $customer->id) }}"><i class="fa-solid fa-pencil"></i> Edit</a>
                            <button class="btn btn-danger p-0 px-2" type="submit" onclick="alert('Yakin ingin menghapus?')"><i class="fa-solid fa-trash"></i> Hapus</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{$customers->links()}}
</div>
@endsection
