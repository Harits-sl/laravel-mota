@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="my-1"> {{ $title }} </h1>
                <table class="table-striped table-hover table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- variabel untuk nomor -->
                        @php
                            $i = 1;
                        @endphp

                        @foreach ($user as $u)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $u->username }}</td>
                                <td>{{ $u->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
