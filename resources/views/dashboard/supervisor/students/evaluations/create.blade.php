@extends('dashboard.supervisor.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold text-center">Penilaian</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <form
                            action="/supervisor/students/{{ $internship_program->id }}/evaluations/{{ $internship_student->id }}"
                            method="POST">
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
                                <label class="form-label">NIS/NPM</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $internship_student->student->id_number }}" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $internship_student->student->name }}" />
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="attitude" class="form-label">Sikap</label>
                                    <input type="number" min="0" max="100" class="form-control text-center" name="attitude" id="attitude"
                                        required value="{{ $internship_student->evaluation->attitude ?? 0 }}" />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="discipline" class="form-label">Disiplin</label>
                                    <input type="number" min="0" max="100" class="form-control text-center" name="discipline" id="discipline"
                                        required value="{{ $internship_student->evaluation->discipline ?? 0 }}" />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="diligence" class="form-label">Ketekunan</label>
                                    <input type="number" min="0" max="100" class="form-control text-center" name="diligence" id="diligence"
                                        required value="{{ $internship_student->evaluation->diligence ?? 0 }}" />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="independent_work" class="form-label">Kerja Mandiri</label>
                                    <input type="number" min="0" max="100" class="form-control text-center" name="independent_work"
                                        id="independent_work" required
                                        value="{{ $internship_student->evaluation->independent_work ?? 0 }}" />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="collaboration" class="form-label">Kerja Sama</label>
                                    <input type="number" min="0" max="100" class="form-control text-center" name="collaboration"
                                        id="collaboration" required
                                        value="{{ $internship_student->evaluation->collaboration ?? 0 }}" />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="accuracy" class="form-label">Ketelitian</label>
                                    <input type="number" min="0" max="100" class="form-control text-center" name="accuracy" id="accuracy"
                                        required value="{{ $internship_student->evaluation->accuracy ?? 0 }}" />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="communication" class="form-label">Komunikasi</label>
                                    <input type="number" min="0" max="100" class="form-control text-center" name="communication"
                                        id="communication" required
                                        value="{{ $internship_student->evaluation->communication ?? 0 }}" />
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="creativity" class="form-label">Kreatifitas</label>
                                    <input type="number" min="0" max="100" class="form-control text-center" name="creativity" id="creativity"
                                        required value="{{ $internship_student->evaluation->creativity ?? 0 }}" />
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <a href="/supervisor/students/{{ $internship_program->id }}/evaluations?student_status={{ $internship_program->student_status }}"
                                    class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
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
