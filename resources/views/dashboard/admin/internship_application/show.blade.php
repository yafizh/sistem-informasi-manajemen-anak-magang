@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Pengajuan Magang</h4>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">NIP</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $internship_application->id_number }}" required />
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $internship_application->name }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Email</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $internship_application->email }}" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Instansi</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $internship_application->institution }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tanggal Mulai Rencana Magang</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $internship_application->start_date }}" />
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tanggal Selesai Rencana Magang</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $internship_application->end_date }}" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 d-flex justify-content-between">
                                    <a href="/admin/internship-application" class="btn btn-secondary">Kembali</a>
                                    <div class="d-flex gap-3">
                                        <form
                                            action="/admin/internship-application/reject/{{ $internship_application->id }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </form>
                                        <form
                                            action="/admin/internship-application/approve/{{ $internship_application->id }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Setujui</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
