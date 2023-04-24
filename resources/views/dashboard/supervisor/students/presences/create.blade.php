@extends('dashboard.supervisor.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold text-center">Tambah Presensi</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="/supervisor/students/{{ $internship_program->id }}/presences" method="POST">
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
                                <label for="start_date" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required />
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required />
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="/supervisor/students/{{ $internship_program->id }}/presences?student_status={{ $internship_program->student_status }}"
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
