@extends('dashboard.supervisor.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold text-center">Edit Presensi</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <form
                            action="/supervisor/students/{{ $internship_program->id }}/presences/{{ $student_presence->id }}"
                            method="POST">
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
                                <label class="form-label">Tanggal</label>
                                <input type="text" class="form-control" disabled value="{{ $student_presence->date }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIS/NPM</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $student_presence->internshipStudent->student->id_number }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $student_presence->internshipStudent->student->name }}" />
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Status</label>
                                <select name="status" id="status" required class="form-control">
                                    <option value="1" {{ $student_presence->status == '1' ? 'selected' : '' }}>
                                        Hadir
                                    </option>
                                    <option value="" {{ is_null($student_presence->status) ? 'selected' : '' }}>
                                        Tidak Hadir
                                    </option>
                                    <option value="2" {{ $student_presence->status == '2' ? 'selected' : '' }}>
                                        Sakit
                                    </option>
                                    <option value="3" {{ $student_presence->status == '3' ? 'selected' : '' }}>
                                        Izin
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="/supervisor/students/{{ $internship_program->id }}/presences?student_status={{ $internship_program->student_status }}"
                                    class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Kegiatan</label>
                            <textarea class="form-control" disabled>{{ $student_presence->activity }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi Kegiatan</label>
                            <input type="text" class="form-control" disabled
                                value="{{ $student_presence->activity_location }}" />
                        </div>
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
