@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Tambah Siswa/Mahasiswa Magang</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="/admin/internship-students/{{ $internship_program->id }}" method="POST">
                            @csrf
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
                                <label for="id_number" class="form-label">NIS/NPM</label>
                                <select name="student_id" id="student_id" required class="form-control">
                                    <option value="" selected disabled>Pilih Siswa/Mahasiswa</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" data-name="{{ $student->name }}">
                                            {{ $student->id_number }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" disabled id="name" />
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="/admin/internship-students/{{ $internship_program->id }}?student_status={{ $internship_program->student_status }}"
                                    class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('student_id').addEventListener('change', function() {
            document.getElementById('name').value = this[this.selectedIndex].getAttribute('data-name');
        });
    </script>
@endsection
