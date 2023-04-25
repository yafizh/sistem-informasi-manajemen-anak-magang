<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
        <span>: {{is_null($f) ? 'Tidak Ditentukan' : $f}}</span>
        <br>
        <span style="width: 150px; display: inline-block;">Sampai Tanggal</span>
        <span>: {{is_null($t) ? 'Tidak Ditentukan' : $t}}</span>
    </section>
    <main class="p-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center align-middle no-td">No</th>
                    <th class="text-center align-middle">Tanggal Kegiatan Mulai</th>
                    <th class="text-center align-middle">Tanggal Kegiatan Selesai</th>
                    <th class="text-center align-middle">Pembimbing</th>
                    <th class="text-center align-middle">Status</th>
                </tr>
            </thead>
            <tbody>
                @if ($internship_programs->count())
                    @foreach ($internship_programs as $internship_program)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $internship_program->start_date }}</td>
                            <td class="text-center align-middle">{{ $internship_program->end_date }}</td>
                            <td class="text-center align-middle">{{ $internship_program->supervisor->name }}</td>
                            <td class="text-center align-middle">
                                @if ($internship_program->internship_status == 1)
                                    Sedang Berjalan
                                @elseif ($internship_program->internship_status == 2)
                                    Selesai
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
