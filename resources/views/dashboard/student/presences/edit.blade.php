@extends('dashboard.student.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold text-center">Isi Presensi dan Kegiatan</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="/student/presences/{{ $student_presence->id }}" method="POST">
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
                                <label for="activity" class="form-label">Kegiatan</label>
                                <textarea name="activity" id="activity" class="form-control">{{ $student_presence->activity }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="activity_location" class="form-label">Lokasi Kegiatan</label>
                                <input type="text" class="form-control" name="activity_location" id="activity_location"
                                    value="{{ $student_presence->activity_location }}" />
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="/student/presences" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
