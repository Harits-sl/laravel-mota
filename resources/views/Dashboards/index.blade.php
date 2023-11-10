@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col rounded-3 bg-info mx-2 border">
                <div class="d-flex ps-3 pt-5">
                    <div>
                        <i class="fa-solid fa-whiskey-glass fa-2xl" style="color: #000000;"></i>
                        <h2 class="text-dark pt-2">Produk</h2>
                        <p class="text-white">
                            {{ $products }} Produk
                        </p>
                    </div>
                </div>
            </div>
            <div class="col rounded-3 bg-success mx-2 border">
                <div class="d-flex ps-3 pt-5">
                    <div>
                        <i class="fa-solid fa-whiskey-glass fa-2xl" style="color: #000000;"></i>
                        <h2 class="text-dark pt-2">Transaksi</h2>
                        <p class="text-white">
                            {{ $transactions }} Transaksi
                        </p>
                    </div>
                </div>
            </div>
            <div class="col rounded-3 bg-danger mx-2 border">
                <div class="d-flex ps-3 pt-5">
                    <div>
                        <i class="fa-solid fa-whiskey-glass fa-2xl" style="color: #000000;"></i>
                        <h2 class="text-dark pt-2">Kustomer</h2>
                        <p class="text-white">
                            {{ $customers }} Kustomer
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
