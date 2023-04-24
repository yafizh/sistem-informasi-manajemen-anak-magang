@extends('dashboard.student.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold text-center">Penilaian</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body row">
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Sikap</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ $evaluation->attitude ?? 0 }}" />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Disiplin</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ $evaluation->discipline ?? 0 }}" />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Ketekunan</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ $evaluation->diligence ?? 0 }}" />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Kerja Mandiri</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ $evaluation->independent_work ?? 0 }}" />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Kerja Sama</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ $evaluation->collaboration ?? 0 }}" />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Ketelitian</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ $evaluation->accuracy ?? 0 }}" />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Komunikasi</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ $evaluation->communication ?? 0 }}" />
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label">Kreatifitas</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ $evaluation->creativity ?? 0 }}" />
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label">Nilai Rata-Rata</label>
                            <input class="form-control text-center" type="number" disabled
                                value="{{ number_format((float) $average, 2, '.', '') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
