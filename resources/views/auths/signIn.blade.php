@extends('layouts.main')

@section('navbar')
@stop

@section('content')
    <section class="vh-100 bg-dark">
        <div class="h-100 container py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style= 'borderRadius: "1rem";'>
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src={{ url('/images/logomota.jpg') }} alt="login form" class="img-fluid h-100"
                                    style= 'borderRadius: "1rem 0 0 1rem";' />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-lg-5 p-4 text-black">
                                    <form action="/admin/auth/login" method="post">
                                        @csrf
                                        <h5 class="fw-normal mb-3 pb-3" style='letterSpacing: 1;'>
                                            Sign into your account
                                        </h5>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email"
                                                class="form-control form-control-lg" <label class="form-label"
                                                for="email">
                                            Email address
                                            </label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg" <label class="form-label"
                                                for="password">
                                            Password
                                            </label>
                                        </div>

                                        <div class="mb-4 pt-1">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
