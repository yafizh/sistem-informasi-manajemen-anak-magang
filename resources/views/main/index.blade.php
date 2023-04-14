@extends('main.layouts.main')

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center px-5">
                            <img src="/assets/img/logo/logo1.png" class="w-100">
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6 p-2">
                                <a href="/login" class=" btn btn-primary btn-lg text-white w-100">Login</a>
                            </div>
                            <div class="col-12 col-md-6 p-2">
                                <a href="/internship-application" class="btn btn-primary btn-lg text-white w-100">
                                    Daftar Magang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
