@extends('dashboard.supervisor.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Detail Kegiatan Magang</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/internship-programs/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-user me-1"></i> Periode Magang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-link-alt me-1"></i>
                            Siswa/Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}/presences?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-link-alt me-1"></i>
                            Riwayat Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);">
                            <i class="bx bx-link-alt me-1"></i>
                            Tabel Presensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="/supervisor/students/{{ $internship_program->id }}/evaluations?student_status={{ request()->get('student_status') }}">
                            <i class="bx bx-link-alt me-1"></i>
                            Penilaian
                        </a>
                    </li>
                </ul>
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="/supervisor/students/{{ $internship_program->id }}/presence-table">
                            <input type="text" hidden value="{{ request()->get('student_status') }}"
                                name="student_status">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="month" class="form-label">Bulan</label>
                                        <select name="month" id="month" class="form-control" required>
                                            <option value="" disabled selected>Pilih Bulan</option>
                                            @foreach ($filters['month'] as $month)
                                                <option value="{{ $month['value'] }}"
                                                    {{ $month['value'] == $choosed_month ? 'selected' : '' }}>
                                                    {{ $month['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tahun</label>
                                        <select name="year" id="year" class="form-control" required>
                                            <option value="" disabled selected>Pilih Tahun</option>
                                            @foreach ($filters['year'] as $year)
                                                <option value="{{ $year['value'] }}"
                                                    {{ $year['value'] == $choosed_year ? 'selected' : '' }}>
                                                    {{ $year['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label class="form-label d-block" style="visibility: hidden;">Filter</label>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="my-0" />
                    @if ($presence_table)
                        <style>
                            table th.sticky {
                                background-color: white;
                                position: sticky;
                                left: 0;
                                z-index: 4;
                            }

                            table td.sticky {
                                background-color: white;
                                position: sticky;
                                left: 0;
                            }
                        </style>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center align-middle fit">No</th>
                                            <th rowspan="2" class="text-center align-middle sticky">
                                                NIS/Nama</th>
                                            <th class="text-center" colspan="{{ $last_day_of_month }}">Tanggal</th>
                                        </tr>
                                        <tr>
                                            @for ($i = 1; $i <= $last_day_of_month; $i++)
                                                <th class="text-center">{{ $i }}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presence_table as $student)
                                            <tr>
                                                <td class="fit text-center">{{ $loop->iteration }}</td>
                                                <td class="sticky">{{ $student['id_number'] }}/{{ $student['name'] }}</td>
                                                @foreach ($student['presences'] as $presence)
                                                    @if ($presence == 1)
                                                        <td class="text-center">H</td>
                                                    @elseif ($presence == 2)
                                                        <td class="text-center">S</td>
                                                    @elseif ($presence == 3)
                                                        <td class="text-center">I</td>
                                                    @elseif ($presence == null)
                                                        @if ($loop->iteration < Date('d'))
                                                            <td class="text-center">A</td>
                                                        @else
                                                            <td class="text-center"></td>
                                                        @endif
                                                    @else
                                                        <td class="text-center">{{ $presence }}</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p class="pt-3"><strong>Keterangan</strong></p>
                            <table>
                                <tr>
                                    <td class="text-center">-</td>
                                    <td class="px-2">:</td>
                                    <td>Tidak Ada Presensi</td>
                                </tr>
                                <tr>
                                    <td class="text-center">A</td>
                                    <td class="px-2">:</td>
                                    <td>Tidak Hadir</td>
                                </tr>
                                <tr>
                                    <td class="text-center">H</td>
                                    <td class="px-2">:</td>
                                    <td>Hadir</td>
                                </tr>
                                <tr>
                                    <td class="text-center">S</td>
                                    <td class="px-2">:</td>
                                    <td>Sakit</td>
                                </tr>
                                <tr>
                                    <td class="text-center">I</td>
                                    <td class="px-2">:</td>
                                    <td>Izin</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
