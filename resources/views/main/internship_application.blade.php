@extends('main.layouts.main')

@section('content')
    <div class="container">
        <div class="authentication-wrapper container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center px-5 mb-3">
                            <img src="/assets/img/logo/logo1.png" style="width: 12rem;">
                        </div>

                        <h4 class="mb-2">Daftar Magang</h4>
                        <p class="mb-4">Silakan isi form di bawah ini untuk keperluan data pengajuan magang</p>
                        <!-- /Logo -->
                        <form class="mb-3" action="/internship-application" method="POST">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="id_number" class="form-label">NIS/NIM/NPM</label>
                                        <input type="text" class="form-control" id="id_number" name="id_number"
                                            placeholder="Masukkan NIS/NIM/NPM" autofocus />
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan Nama Lengkap" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Masukkan Email" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="institution" class="form-label">Nama Sekolah atau Nama Kampus</label>
                                        <input type="text" class="form-control" id="institution" name="institution"
                                            placeholder="Masukkan Nama Sekolah atau Nama Kampus" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Rencana Tanggal Mulai Magang</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            placeholder="Masukkan Tanggal Mulai Magang" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Rencana Tanggal Selesai Magang</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            placeholder="Masukkan Tanggal Selesai Magang" />
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <button class="btn btn-primary d-grid w-100" type="submit">Daftar Magang</button>
                                    </div>
                                    <p class="text-center">
                                        <a href="/login">
                                            <span>Login</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
