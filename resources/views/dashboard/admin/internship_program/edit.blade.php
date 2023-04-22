@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Edit Data Kegiatan Magang</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="/admin/internship-programs/{{ $internship_program->id }}" method="POST">
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
                                <select name="employee_id" id="employee_id" required class="form-control">
                                    <option value="{{ $internship_program->supervisor->id }}" selected>
                                        {{ $internship_program->supervisor->id_number }}
                                    </option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" data-name="{{ $employee->name }}">
                                            {{ $employee->id_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" disabled id="name"
                                    value="{{ $internship_program->supervisor->name }}" />
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Tanggal Mulai Kegiatan</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" required
                                    value="{{ $internship_program->start_date }}" />
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Tanggal Selesai Kegiatan</label>
                                <input type="date" class="form-control" name="end_date" id="end_date" required
                                    value="{{ $internship_program->end_date }}" />
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="/admin/supervisor" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('employee_id').addEventListener('change', function() {
            document.getElementById('name').value = this[this.selectedIndex].getAttribute('data-name');
        });
    </script>
@endsection
