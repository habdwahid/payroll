@extends('dashboard.layouts.app')

@section('content')
@if (session()->has('status'))
<div class="position-absolute start-50">
    <div class="alert alert-dismissible alert-success fade show" role="alert">
        <i class="fa-solid fa-fw fa-circle-check me-1"></i>{{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Absensi</h1>
</div>

<div class="text-end mb-3">
    <a href="{{ route('keuangan.absensi.create') }}" class="btn btn-primary"><i class="fa-solid fa-fw fa-plus me-1"></i>Rekap Absensi</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-fw fa-table me-1"></i>Data Absensi</h6>
    </div>
    <div class="card-body px-lg-4">
        <form action="{{ route('keuangan.absensi.index') }}" method="get">
            @csrf
            <div class="d-flex gap-2 mb-3">
                <div class="mb-3">
                    <label for="month" class="form-label">Bulan</label>
                    <select name="month" id="month" class="form-select form-select-sm text-muted" required>
                        <option value="">-</option>
                        <option value="01" @selected( request('month')=='01' )>Januari</option>
                        <option value="02" @selected( request('month')=='02' )>Februari</option>
                        <option value="03" @selected( request('month')=='03' )>Maret</option>
                        <option value="04" @selected( request('month')=='04' )>April</option>
                        <option value="05" @selected( request('month')=='05' )>Mei</option>
                        <option value="06" @selected( request('month')=='06' )>Juni</option>
                        <option value="07" @selected( request('month')=='07' )>Juli</option>
                        <option value="08" @selected( request('month')=='08' )>Agustus</option>
                        <option value="09" @selected( request('month')=='09' )>September</option>
                        <option value="10" @selected( request('month')=='10' )>Oktober</option>
                        <option value="11" @selected( request('month')=='11' )>November</option>
                        <option value="12" @selected( request('month')=='12' )>Desember</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Tahun</label>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <input type="number" name="year" id="year" class="form-control form-control-sm" min="2022" value="{{ ((empty(request('year'))) ? date('Y') : request('year')) }}" max="{{ date('Y') }}" required>
                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </form>
        <h6>{{ (empty(request('month')) ? date('F Y') : date('F', mktime(0,0,0,request('month'),10))) }}</h6>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="col-2" scope="col">NIK</th>
                        <th class="col-3" scope="col">Nama</th>
                        <th class="col-2" scope="col">Jenis Kelamin</th>
                        <th class="col-1" scope="col">Hadir</th>
                        <th class="col-1" scope="col">Izin</th>
                        <th class="col-1" scope="col">Sakit</th>
                        <th class="col-1" scope="col">Absen</th>
                        <th class="col-1" scope="col"><i class="fa-solid fa-fw fa-screwdriver-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendanceLists as $attendanceList)
                    <tr class="text-center align-middle">
                        <td>{{ $attendanceList->user->nik }}</td>
                        <td class="text-capitalize text-start">{{ $attendanceList->user->name }}</td>
                        <td>{{ $attendanceList->user->user_data->sex }}</td>
                        <td>{{ $attendanceList->present }}</td>
                        <td>{{ $attendanceList->has_permission }}</td>
                        <td>{{ $attendanceList->sick }}</td>
                        <td>{{ $attendanceList->absent }}</td>
                        <td>
                            <a href="{{ route('keuangan.absensi.edit', ['attendanceList' => $attendanceList]) }}" class="btn btn-sm btn-primary border-0" title="Update"><i class="fa-solid fa-sm fa-fw fa-square-pen"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center align-middle">
                        <td colspan="8">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $attendanceLists->links() }}
    </div>
</div>
@endsection