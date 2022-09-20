<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif;
        }

        .align-middle {
            vertical-align: middle;
        }

        .block {
            display: block;
        }

        .border {
            border: 1px solid black;
        }

        .border-bottom {
            border-bottom: 1px solid black;
        }

        .border-top {
            border-top: 1px solid black;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .col {
            width: auto;
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

        .col-4 {
            width: 33.3333333%;
        }

        .col-5 {
            width: 41.6666667%;
        }

        .col-6 {
            width: 50%;
        }

        .col-7 {
            width: 58.3333333%;
        }

        .col-8 {
            width: 66.6666666%;
        }

        .col-9 {
            width: 75%;
        }

        .col-10 {
            width: 83.3333333%;
        }

        .container {
            padding: 1rem;
        }

        .float-left {
            float: left;
        }

        .float-none {
            float: none;
        }

        .float-right {
            float: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .inline-block {
            display: inline-block;
        }

        .m-0 {
            margin: 0;
        }

        .m-1 {
            margin: 0.25rem;
        }

        .m-2 {
            margin: 0.5rem;
        }

        .m-3 {
            margin: 0.75rem;
        }

        .m-4 {
            margin: 1rem;
        }

        .m-auto {
            margin: auto;
        }

        .ml-0 {
            margin-left: 0;
        }

        .ml-1 {
            margin-left: 0.25rem;
        }

        .ml-2 {
            margin-left: 0.5rem;
        }

        .ml-3 {
            margin-left: 0.75rem;
        }

        .ml-4 {
            margin-left: 1rem;
        }

        .ml-5 {
            margin-left: 1.25rem;
        }

        .ml-6 {
            margin-left: 1.5rem;
        }

        .ml-7 {
            margin-left: 1.75rem;
        }

        .ml-8 {
            margin-left: 2rem;
        }

        .ml-9 {
            margin-left: 2.25rem;
        }

        .ml-10 {
            margin-left: 2.5rem;
        }

        .ml-11 {
            margin-left: 2.75rem;
        }

        .ml-12 {
            margin-left: 3rem;
        }

        .ml-auto {
            margin-left: auto;
        }

        .mr-0 {
            margin-right: 0;
        }

        .mr-1 {
            margin-right: 0.25rem;
        }

        .mr-2 {
            margin-right: 0.5rem;
        }

        .mr-3 {
            margin-right: 0.75rem;
        }

        .mr-4 {
            margin-right: 1rem;
        }

        .mr-auto {
            margin-right: auto;
        }

        .mt-0 {
            margin-top: 0;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 0.75rem;
        }

        .mt-4 {
            margin-top: 1rem;
        }

        .mt-auto {
            margin-top: auto;
        }

        .overflow-auto {
            overflow: auto;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .p-0 {
            padding: 0;
        }

        .p-1 {
            padding: 0.25rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .p-3 {
            padding: 0.75rem;
        }

        .p-4 {
            padding: 1rem;
        }

        .pt-0 {
            padding-top: 0;
        }

        .pt-1 {
            padding-top: 0.25rem;
        }

        .pt-2 {
            padding-top: 0.5rem;
        }

        .pt-3 {
            padding-top: 0.75rem;
        }

        .pt-4 {
            padding-top: 1rem;
        }

        .pt-8 {
            padding-top: 2rem;
        }

        .pt-12 {
            padding-top: 3rem;
        }

        .pt-14 {
            padding-top: 3.5rem;
        }

        .small {
            font-size: smaller;
        }

        .table {
            width: 100%;
        }

        .text-capitalize {
            text-transform: capitalize;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-lowercase {
            text-transform: lowercase;
        }

        .text-right {
            text-align: right;
        }

        .text-decoration-underline {
            text-decoration: underline;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .w-50 {
            width: 50%;
        }

        .w-100 {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="border">
            <div class="border-bottom p-4 clearfix">
                <img src="{{ asset('assets/img/cita-mandiri.png') }}" alt="CV. Cita Mandiri" class="float-left" style="width: 150px;">
                <div class="ml-4">
                    <p>CV. CITA MANDIRI</p>
                    <p class="small">Jl. Bhayangkara No. 24, Sumurpecung, Serang, Kota Serang, Banten.</p>
                </div>
            </div>
            <div class="border-bottom p-1">
                <h4 class="text-center">SLIP GAJI</h4>
                <div class="pt-4">
                    <table class="table">
                        <tbody>
                            <tr class="align-middle">
                                <td class="col-2">NIK</td>
                                <td class="col">: {{ $attendanceList->user->nik }}</td>
                            </tr>
                            <tr class="align-middle">
                                <td class="col-2">Nama</td>
                                <td class="text-uppercase">: {{ $attendanceList->user->name }}</td>
                            </tr>
                            <tr class="align-middle">
                                <td class="col-2">Jabatan</td>
                                <td class="text-capitalize">: {{ $attendanceList->user->user_data->position->position }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="border-bottom p-1">
                <h5 class="float-left">PENERIMAAN</h5>
                <h5 class="text-right">POTONGAN</h5>
            </div>
            <div class="border-bottom p-1">
                <table class="table">
                    <tbody>
                        <tr class="align-middle">
                            <td class="small col-3">Gaji Pokok</td>
                            <td class="small col-1">:</td>
                            <td class="small col-2 text-right">{{ 'Rp. ' . number_format($attendanceList->user->user_data->position->salary->salary) }}</td>
                            <td class="col-2"></td>
                            <td class="small col-1">Absen</td>
                            <td class="small col-1 text-right">:</td>
                            <td class="small col-2 text-right">{{ 'Rp. ' . number_format($absent) }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td class="small col-3">Tunjangan Makan</td>
                            <td class="small col-1">:</td>
                            <td class="small col-2 text-right">{{ 'Rp. ' . number_format($attendanceList->user->user_data->position->salary->meal_allowance) }}</td>
                            <td class="col-2"></td>
                            <td class="small col-1">Izin</td>
                            <td class="small col-1 text-right">:</td>
                            <td class="small col-2 text-right">{{ 'Rp. ' . number_format($permission) }}</td>
                        </tr>
                        <tr class="align-middle">
                            <td class="small col-3">Tunjangan Transport</td>
                            <td class="small col-1">:</td>
                            <td class="small col-2 text-right">{{ 'Rp. ' . number_format($attendanceList->user->user_data->position->salary->transport_allowance) }}</td>
                            <td class="col-2"></td>
                            <td class="small col-1">Sakit</td>
                            <td class="small col-1 text-right">:</td>
                            <td class="small col-2 text-right">{{ 'Rp. ' . number_format($sick) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="border-bottom p-1">
                <table class="table">
                    <tbody>
                        <tr class="align-middle">
                            <th class="small col-3 text-left" scope="row">TOTAL PENERIMAAN</th>
                            <th class="small col-1" scope="row"></th>
                            <th class="small col-2 text-right" scope="row">{{ 'Rp. ' . number_format($penerimaan) }}</th>
                            <th class="small col-1" scope="row"></th>
                            <th class="small col-3" scope="row">TOTAL POTONGAN</th>
                            <th class="small col-2 text-right" scope="row">{{ 'Rp. ' . number_format($potongan) }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                <table class="table">
                    <tbody>
                        <tr class="align-middle">
                            <th class="small col-1" scope="row"></th>
                            <th class="small col-2 text-left" scope="row">THP</th>
                            <th class="small col-1" scope="row"></th>
                            <th class="small col-2 text-right" scope="row"><span class="text-decoration-underline">{{ 'Rp. ' . number_format($penerimaan - $potongan) }}</span></th>
                            <th class="small col-2" scope="row"></th>
                            <td class="small col-4 text-right">Serang, {{ $attendanceList->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table mt-1">
                    <tbody>
                        <tr class="align-middle small text-center">
                            <td class="col-3">Payroll</td>
                            <td class="col-6"></td>
                            <td class="col-3">Diterima Oleh</td>
                        </tr>
                        <tr class="align-middle small text-center">
                            <td class="col-3 border-bottom pt-14"></td>
                            <td class="col-6 pt-14"></td>
                            <td class="col-3 text-uppercase pt-14">{{ $attendanceList->user->name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>