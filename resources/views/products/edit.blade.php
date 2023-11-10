@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h2 class="my-3">{{ $title }}</h2>

                <form action="/admin/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" autofocus
                                value="{{ $product->name }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" name="description"
                                value="{{ $product->description }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ $product->price }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="image" name="image">
                                <label class="input-group-text" for="image">Pilih gambar..</label>
                            </div>
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="gridRadios1"
                                    value="coffee" {{ $product->type == 'coffee' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadios1">
                                    Coffee
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="gridRadios2"
                                    value="non-coffee" {{ $product->type == 'non-coffee' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadios2">
                                    Non Coffee
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
