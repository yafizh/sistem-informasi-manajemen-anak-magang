@extends('dashboard.admin.layouts.dashboard')

@section('content')
    <style>
        #DataTables_Table_0_wrapper .row:first-child,
        #DataTables_Table_0_wrapper .row:last-child {
            margin: 1rem;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold">Laporan Tabel Presensi {{ request()->get('student_status') == 1 ? 'Siswa' : 'Mahasiswa' }}</h4>

        <form action="">
            <input type="text" name="student_status" value="{{ request()->get('student_status') }}" hidden>
            <div class="row">
                <div class="col-12 col-md-4 mb-3">
                    <label for="student_id" class="form-label">
                        Nama {{ request()->get('student_status') == 1 ? 'Siswa' : 'Mahasiswa' }}
                    </label>
                    <select name="student_id" id="student_id" class="form-control" required>
                        <option value="" disabled selected>
                            Pilih {{ request()->get('student_status') == 1 ? 'Siswa' : 'Mahasiswa' }}
                        </option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" data-id_number="{{ $student->id_number }}"
                                {{ request()->get('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label">{{ request()->get('student_status') == 1 ? 'NIS/NISN' : 'NIM/NPM' }}</label>
                    <input type="text" class="form-control" id="id_number" disabled>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <label class="form-label d-block" style="visibility: hidden;">Button</label>
                    <button type="submit" class="btn btn-success">Filter</button>
                    <a href="/admin/print/student-presence-table?student_status={{ request()->get('student_status') }}&student_id={{ request()->get('student_id') }}"
                        class="btn btn-primary" target="_blank">
                        Cetak
                    </a>
                </div>
            </div>
        </form>

        @if ($table)
            <div class="card">
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
                                    <th rowspan="2" class="text-center align-middle sticky">Bulan</th>
                                    <th class="text-center" colspan="31">Tanggal</th>
                                </tr>
                                <tr>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <th class="text-center">{{ $i }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($table as $item)
                                    <tr>
                                        <td class="sticky">{{ $item['date'] }}</td>
                                        @foreach ($item['presences'] as $presence)
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
            </div>
        @endif
    </div>

    <script>
        document.getElementById('student_id').addEventListener('change', function() {
            document.getElementById('id_number').value = this[this.selectedIndex].getAttribute('data-id_number');
        });
    </script>
@endsection
