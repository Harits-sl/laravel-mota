@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="/admin/products/create" class="btn btn-primary my-3">Tambah Data Produk</a>
                <h1 class="my-1">{{ $title }}</h1>
                <table class="table-striped table-hover table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($products as $p)
                            <tr>
                                <th scope="row"> {{ $i++ }}</th>
                                <td><img src="{{ $p->image }}" alt="" style="width: 6rem">
                                </td>
                                <td>{{ $p->name }} </td>
                                <td> {{ $p->price }}</td>
                                <td>
                                    <a href="/admin/products/{{ $p->id }} " class="btn btn-success">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
