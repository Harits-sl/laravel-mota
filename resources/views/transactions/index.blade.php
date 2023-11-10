@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="my-1 pt-3"> {{ $title }} </h3>

                <!-- START FORM SEARCH TRANSACTION -->
                <form action="/admin/transactions/search" method="post">
                    @csrf
                    <div class="container my-3 border py-3">
                        <div class="row">
                            <div class="col">
                                <h4> Search Date</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <label for="tanggal-1" class="col-1 col-form-label">Date</label>
                                    <div class="col-5 pb-3">
                                        <div class="input-group date" id="datepicker-1">
                                            <input type="text" class="form-control" id="inputTanggal-1"
                                                name="tanggal-1" />
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label for="tanggal-2" class="col-1 col-form-label">S/D</label>
                                    <div class="col-5 pb-3">
                                        <div class="input-group date" id="datepicker-2">
                                            <input type="text" class="form-control" id="inputTanggal-2"
                                                name="tanggal-2" />
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-light d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-grid d-md-flex justify-content-md-start gap-2">
                                    <button class="btn btn-primary me-md-1" type="submit"><i class="fa-solid fa-search"
                                            style="color: #ffffff;"></i>Search</button>
                                    <button type="reset" class="btn btn-outline-dark">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM SEARCH TRANSACTION -->

                {{-- jika input dengan name sort kosong atau null --}}
                @if (app('request')->input('sort') == null)
                    {{-- untuk tampilan filter date --}}
                    @if ($isSearch)
                        <form action="{{ url()->current() }}" method="post">
                            @csrf
                            <input type="hidden" name="sort" value='desc'>
                            <input type="hidden" name="tanggal-1" value="{{ $dateFrom }}">
                            <input type="hidden" name="tanggal-2" value="{{ $dateTo }}">
                            <button type="submit" class="btn btn-primary">
                                Sort Date Latest
                            </button>
                        </form>
                    @else
                        <form action="{{ url()->current() }}" method="get">
                            @csrf
                            <input type="hidden" name="sort" value='desc'>
                            <button type="submit" class="btn btn-primary">
                                Sort Date by Latest
                            </button>
                        </form>
                    @endif
                @else
                    @if ($isSearch)
                        <form action="{{ url()->current() }}" method="post">
                            @csrf
                            <input type="hidden" name="tanggal-1" value="{{ $dateFrom }}">
                            <input type="hidden" name="tanggal-2" value="{{ $dateTo }}">
                            <button type="submit" class="btn btn-primary">
                                Sort Date by Newest
                            </button>
                        </form>
                    @else
                        <a href="{{ url()->current() }}">
                            <button type="submit" class="btn btn-primary">
                                Sort Date by Newest
                            </button>
                        </a>
                    @endif
                @endif


                <table class="table-dark table-borderless table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Nama Menu</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Harga / Produk</th>
                            <th scope="col">Harga Total</th>
                            <th scope="col">Tipe</th>
                            <th scope="col">Bukti</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($orders as $o)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $o->username }}</td>
                                <td>
                                    @foreach ($o->order_product as $product)
                                        {{ $product['name'] }}
                                        <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($o->order_product as $product)
                                        {{ $product['quantity'] }}
                                        <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($o->order_product as $product)
                                        {{ $product['price'] }}
                                        <br>
                                    @endforeach
                                </td>
                                <td>{{ $o->total }}</td>
                                <td>{{ $o->payment_method }}</td>
                                <td>
                                    <img src='{{ $o->transfer_receipt }}' alt="" class="buktibayar"
                                        style="width: 100px; min-height: 0; max-height: 100px; object-fit: cover;"
                                        type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#imageModal"
                                        onclick="sendImageToModal('{{ $o->transfer_receipt }}')">
                                </td>
                                <td>
                                    <?= date('m/d/Y', strtotime($o['created_at'])) ?>
                                </td>
                                {{-- STATUS BADGE --}}
                                @switch($o['status'])
                                    @case('Sukses')
                                        <td><span class="badge text-bg-success"><?= $o['status'] ?></td>
                                    @break

                                    @case('Di Proses')
                                        <td><span class="badge text-bg-primary"><?= $o['status'] ?></td>
                                    @break

                                    @case('Pembayaran')
                                        <td><span class="badge text-bg-warning"><?= $o['status'] ?></td>
                                    @break

                                    @default
                                        <td><span class="badge text-bg-danger"><?= $o['status'] ?></td>
                                @endswitch

                                <td>
                                    {{-- jika status sukses --}}
                                    @if ($o['status'] == 'Sukses')
                                        <a href="/admin/transactions/<?= $o['id'] ?>" class="btn btn-primary"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Detail Transaksi"><i class="fa-solid fa-circle-info"></i></a>
                                    @endif

                                    {{-- jika status bukan sukses --}}
                                    @if ($o['status'] == 'Di Proses')
                                        <a href="/admin/transactions/success/<?= $o['id'] ?>" class="btn btn-success"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Pesanan Selesai"><i class="fa-solid fa-check"></i></a>
                                    @endif

                                    {{-- jika payment method cashier dan status pembayaran --}}
                                    @if ($o['payment_method'] == 'cashier' && $o['status'] == 'Pembayaran')
                                        <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title="Masukan Pembayaran"
                                            onclick="returnDataToModal(<?= $o['id'] ?>, <?= $o['total'] ?>)"><i
                                                class="fa-solid fa-money-bill"></i></a>
                                    @endif



                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal -->
    <form onsubmit='return submitPay(this)' method="post">
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content text-dark">
                    <div class="modal-header">
                        <h1 class="modal-title fs-4 fw-bold text-center" id="exampleModalLabel">CASH</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-between">
                            <div class="col">
                                <p>
                                    ID Pesanan
                                <p>
                                <p>
                                    Total
                                <p>
                            </div>
                            <div class="col text-end">
                                <p class="id-order">
                                    ID Pesanan
                                <p>
                                <p class="total-order">
                                    Total
                                <p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row btn-group px-5" role="group" aria-label="Basic radio toggle button group">
                        <div class="d-grid col-6 mx-auto gap-2">
                            <input type="checkbox" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                                value="100000" checked>
                            <label class="btn btn-outline-primary" for="btnradio1">100.000</label>
                            <input type="checkbox" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off"
                                value="20000">
                            <label class="btn btn-outline-primary" for="btnradio2">20.000</label>
                        </div>
                        <div class="d-grid col-6 mx-auto gap-2">
                            <input type="checkbox" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"
                                value="30000">
                            <label class="btn btn-outline-primary" for="btnradio3">30.000</label>
                            <input type="checkbox" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off"
                                value="50000">
                            <label class="btn btn-outline-primary" for="btnradio4">50.000</label>
                        </div>
                    </div>
                    <hr>
                    <div class="col px-5">
                        <p class="text-center">Masukan Uang</p>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control form-pay" name="bayar"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                        <div class="row justify-content-between pb-3">
                            <div class="col-4">
                                Kembalian
                            </div>
                            <input type="hidden" class="form-control form-change" name="kembalian"
                                aria-label="Amount (to the nearest dollar)">
                            <span class="col-4 change text-end">
                                0
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-submit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Image -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Bukti Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" class="img-fluid image-modal" alt="...">
                </div>
            </div>
        </div>
    </div>
@endsection
