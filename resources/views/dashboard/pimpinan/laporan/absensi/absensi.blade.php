<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        table,
        th,
        td {
            border: 1px solid;
            border-collapse: collapse;
        }

        th,
        td {
            padding: .5rem;
        }

        .align-middle {
            vertical-align: middle;
        }

        .container {
            padding-top: 2.54cm;
            padding-right: 2.54cm;
            padding-bottom: 2.54cm;
            padding-left: 4cm;
        }

        .col-1 {
            width: 8.33333333%;
        }

        .col-2 {
            width: 16.6666667%;
        }

        .col-3 {
            width: 25%;
        }

        .text-center {
            text-align: center;
        }

        .fw-bold {
            font-weight: bold;
        }

        .line-h-15 {
            line-height: 1.5;
        }

        .line-h-2 {
            line-height: 2;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 0.75rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .table {
            width: 100%;
        }

        .text-capitalize {
            text-transform: capitalize;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-uppercase {
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="container line-h-15">
        <div class="mb-4">
            <h5 class="text-center" style="font-size: 14;">LAPORAN ABSENSI</h5>
        </div>
        <div>
            <p>@php setlocale(LC_TIME, "id.UTF-8"); echo strftime('%B %G', mktime(0, 0, 0, $month, 10, $year)) @endphp</p>
            <table class="table">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="col-1" scope="col">NIK</th>
                        <th class="col-3" scope="col">Nama</th>
                        <th class="col-2" scope="col">Jenis Kelamin</th>
                        <th class="col-2" scope="col">Jabatan</th>
                        <th class="col-1" scope="col">Hadir</th>
                        <th class="col-1" scope="col">Izin</th>
                        <th class="col-1" scope="col">Sakit</th>
                        <th class="col-1" scope="col">Absen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendanceList as $a)
                    <tr class="text-center align-middle">
                        <td>{{ $a->user->nik }}</td>
                        <td class="text-left text-capitalize">{{ $a->user->name }}</td>
                        <td>{{ $a->user->user_data->sex }}</td>
                        <td>{{ ((empty($a->user->user_data->position_id)) ? '-' : $a->user->user_data->position->position) }}</td>
                        <td>{{ $a->present }}</td>
                        <td>{{ $a->has_permission }}</td>
                        <td>{{ $a->sick }}</td>
                        <td>{{ $a->absent }}</td>
                    </tr>
                    @empty
                    <tr class="text-center align-middle">
                        <td colspan="8">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="text-right">
                <p>Dicetak oleh <span class="text-capitalize">{{ auth()->user()->name }}</span></p>
                <p>{{ now()->isoFormat('dddd, D MMMM YYYY HH:m:ss') }}</p>
            </div>
        </div>
    </div>
</body>

</html>