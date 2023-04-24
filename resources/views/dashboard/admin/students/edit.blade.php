@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Edit Data {{request()->get('student_status') == 1 ? 'Siswa' : 'Mahasiswa'}}</h4>

        <form action="/admin/students/{{ $student->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger text-capitalize" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="id_number" class="form-label">NIM/NIS/NPM</label>
                                <input type="text" class="form-control" id="id_number" name="id_number"
                                    placeholder="NIP Pegawai" value="{{ old('id_number', $student->id_number) }}"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nama Pegawai" value="{{ old('name', $student->name) }}" required />
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="Nomor Telepon Pegawai"
                                    value="{{ old('phone_number', $student->phone_number) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="birth_place" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place"
                                    placeholder="Tempat Lahir Pegawai"
                                    value="{{ old('birth_place', $student->birth_place) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                    placeholder="Tangga Lahir Pegawai"
                                    value="{{ old('birth_date', $student->birth_date) }}" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email Nama Pegawai" value="{{ old('email', $student->email) }}" required />
                            </div>
                            <div class="mb-3">
                                <label for="sex" class="form-label">Jenis Kelamin</label>
                                <select name="sex" id="sex" class="form-control">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki - Laki"
                                        {{ old('sex', $student->sex) === 'Laki - Laki' ? 'selected' : '' }}>
                                        Laki -
                                        Laki</option>
                                    <option value="Perempuan"
                                        {{ old('sex', $student->sex) === 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="institution" class="form-label">Nama Sekolah atau Nama Kampus</label>
                                <input type="text" class="form-control" id="institution" name="institution"
                                    placeholder="Nama Sekolah atau Nama Kampus"
                                    value="{{ old('institution', $student->institution) }}" />
                            </div>
                            <div class="mb-3">
                                <label for="student_status" class="form-label">Status</label>
                                <select name="student_status" id="student_status" class="form-control" required>
                                    <option value="" selected disabled>Pilih Status</option>
                                    <option value="1"
                                        {{ old('student_status', $student->student_status) == 1 ? 'selected' : '' }}>
                                        Siswa</option>
                                    <option value="2"
                                        {{ old('student_status', $student->student_status) == 2 ? 'selected' : '' }}>
                                        Mahasiswa
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="photo" name="photo">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <a href="/admin/students?student_status={{ $student->student_status }}"
                            class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
