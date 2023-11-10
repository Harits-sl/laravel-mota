@extends('layouts.main')

@section('content')
    <div class="container mb-3">
        <div class="row">
            <div class="col">
                <h2 class="py-3"> {{ $title }} </h2>
                <div class="border-3 rounded-5 container border py-5">
                    <div class="row">
                        <div class="col text-center">
                            <div>
                                <img class="rounded-circle me-3" src="{{ asset('images/logomota.jpg') }}" width="70"
                                    alt="">
                            </div>
                            <div>
                                <h5 class="fw-bold nopadding pt-2">Motamorph Coffee</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center pt-4">
                        <h5 class="col-4 fw-bold">Nama</h5>
                        <div class="col-4 text-end">
                            <h5 class="fw-bold">{{ $order->username }}</h5>
                        </div>
                    </div>
                    <div class="container pt-2">
                        @foreach ($order->order_product as $product)
                            <div class="row justify-content-center">
                                <p class="col-3">{{ $product['name'] }}</p>
                                <p class="col-2">x {{ $product['quantity'] }}</p>
                                <div class="col-3 text-end">
                                    <p>Rp. {{ $product['price'] }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="row justify-content-center mt-1">
                            <hr class="border-dark border border-2 opacity-100" style="width: 68%;">
                        </div>
                        <div class="row justify-content-center pt-2">
                            <p class="col-4">Cash</p>
                            <div class="col-4 text-end">
                                <p>Rp.{{ $order->pay }}</p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <p class="col-4">Kembalian</p>
                            <div class="col-4 text-end">
                                <p>Rp. {{ $order->change }}</p>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <h5 class="col-4 fw-bold">Total Payment</h5>
                            <div class="col-4 text-end">
                                <h5 class="fw-bold">Rp. {{ $order->total }}</h5>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-1">
                            <hr class="border-dark border border-2 opacity-100" style="width: 68%;">
                        </div>
                        <div class="row justify-content-center mt-1">
                            <h3 class="text-center">Terima Kasih!!</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
