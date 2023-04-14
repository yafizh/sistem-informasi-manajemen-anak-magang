@extends('dashboard.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Edit Data Pegawai</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="/admin/employees/{{ $employee->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger text-capitalize" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="id_number" class="form-label">NIP</label>
                                <input type="text" class="form-control" id="id_number" name="id_number"
                                    placeholder="NIP Pegawai" value="{{ old('id_number', $employee->id_number) }}"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Nama Pegawai" value="{{ old('name', $employee->name) }}" required />
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="Nomor Telepon Pegawai"
                                    value="{{ old('phone_number', $employee->phone_number) }}" required />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email Nama Pegawai" value="{{ old('email', $employee->email) }}"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="birth_place" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place"
                                    placeholder="Tempat Lahir Pegawai"
                                    value="{{ old('birth_place', $employee->birth_place) }}" required />
                            </div>
                            <div class="mb-3">
                                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                    placeholder="Tangga Lahir Pegawai"
                                    value="{{ old('birth_date', $employee->birth_date) }}" required />
                            </div>
                            <div class="mb-3">
                                <label for="se" class="form-label">Jenis Kelamin</label>
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki - Laki"
                                        {{ old('sex', $employee->sex) === 'Laki - Laki' ? 'selected' : '' }}>Laki -
                                        Laki</option>
                                    <option value="Perempuan"
                                        {{ old('sex', $employee->sex) === 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="photo" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="photo" name="photo" />
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="/admin/employees" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
