<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('dashboard.admin.prints.header')
    <h4 class="text-center my-3">Laporan</h4>
    <section class="p-3">
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Dari Tanggal</span>
        <span>: {{ is_null($f) ? 'Tidak Ditentukan' : $f }}</span>
        <br>
        <span style="width: 150px; display: inline-block;">Sampai Tanggal</span>
        <span>: {{ is_null($t) ? 'Tidak Ditentukan' : $t }}</span>
    </section>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle no-td">No</th>
                    <th class="text-center align-middle">Tanggal</th>
                    <th class="text-center align-middle">
                        {{ request()->get('student_status') == 1 ? 'NIS/NISN' : 'NIM/NPM' }}
                    </th>
                    <th class="text-center align-middle">Nama Lengkap</th>
                    <th class="text-center align-middle">Status</th>
                </tr>
            </thead>
            <tbody>
                @if ($presences->count())
                    @foreach ($presences as $presence)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $presence->date }}</td>
                            <td class="text-center align-middle">
                                {{ $presence->internshipStudent->student->id_number }}
                            </td>
                            <td class="align-middle">{{ $presence->internshipStudent->student->name }}</td>
                            <td class="text-center align-middle">
                                @if ($presence->status == 1)
                                    Hadir
                                @elseif ($presence->status == 2)
                                    Sakit
                                @elseif ($presence->status == 3)
                                    Izin
                                @else
                                    @if ($presence->date < Date('Y-m-d'))
                                        Alpa
                                    @else
                                        Belum Mengisi Presensi
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="5">Tidak Ada Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
    @include('dashboard.admin.prints.footer')
</body>

</html>
