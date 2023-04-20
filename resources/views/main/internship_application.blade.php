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
                                <div class="col-12">
                                    @if ($errors->any())
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger text-capitalize" role="alert">
                                                {{ $error }}
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="id_number" class="form-label">NIS/NIM/NPM</label>
                                        <input type="text" class="form-control" id="id_number" name="id_number"
                                            placeholder="Masukkan NIS/NIM/NPM" value="{{ old('id_number') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Masukkan Email" value="{{ old('email') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="student_status" class="form-label">Status</label>
                                        <select name="student_status" id="student_status" class="form-control" required>
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="1" {{ old('id_number') == '1' ? 'selected' : '' }}>
                                                Siswa
                                            </option>
                                            <option value="2" {{ old('id_number') == '2' ? 'selected' : '' }}>
                                                Mahasiswa
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="institution" class="form-label">Nama Sekolah atau Nama Kampus</label>
                                        <input type="text" class="form-control" id="institution" name="institution"
                                            placeholder="Masukkan Nama Sekolah atau Nama Kampus"
                                            value="{{ old('institution') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Rencana Tanggal Mulai Magang</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            placeholder="Masukkan Tanggal Mulai Magang" value="{{ old('start_date') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Rencana Tanggal Selesai Magang</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            placeholder="Masukkan Tanggal Selesai Magang" value="{{ old('end_date') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" style="visibility: hidden;">Button</label>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary d-grid" type="submit">Daftar Magang</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <p class="text-center">
                                        <a href="/login">
                                            <span>Halaman Login</span>
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
