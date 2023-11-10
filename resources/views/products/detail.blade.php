@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>{{ $title }}</h2>
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ $product->image }}" class="img-fluid rounded-start w-100" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text"><b>Deskripsi : </b>{{ $product->description }}</p>
                                <p class="card-text"><b>Harga : </b>{{ $product->price }}</p>
                                <p class="card-text"><b>Tipe Minuman : </b>{{ $product->type }}</p>

                                <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-warning">Edit</a>
                                <form action="/admin/products/{{ $product->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('apakah anda yakin?');">Delete</button>
                                </form>
                                <br><br>
                                <a href="/admin/products">Kembali ke daftar product</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
