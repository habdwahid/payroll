@extends('dashboard.layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Slip Gaji</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 fw-bold text-primary">
            <i class="fa-solid fa-fw fa-table me-1"></i>Data Slip Gaji
        </h6>
    </div>
    <div class="card-body px-lg-4">
        <form action="{{ route('karyawan.slip-gaji.index') }}" method="get">
            @csrf
            <div class="d-flex gap-2">
                <div class="mb-3">
                    <label for="month" class="form-label">Bulan</label>
                    <select name="month" id="month" class="form-select form-select-sm text-muted">
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
                    <div class="d-flex gap-2">
                        <input type="number" name="year" id="year" class="form-control form-control-sm" min="2022" value="{{ ((empty(request('year'))) ? date('Y') : request('year')) }}" max="{{ date('Y') }}" required>
                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="col-1" scope="col">#</th>
                        <th class="col-2" scope="col">NIK</th>
                        <th class="col-3" scope="col">Nama</th>
                        <th class="col-2" scope="col">Jabatan</th>
                        <th class="col-1" scope="col">Bulan</th>
                        <th class="col-1" scope="col">Tahun</th>
                        <th class="col-2" scope="col">
                            <i class="fa-solid fa-fw fa-screwdriver-wrench"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendanceLists as $attendanceList)
                    <tr class="text-center align-middle">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $attendanceList->user->nik }}</td>
                        <td class="text-capitalize">{{ $attendanceList->user->name }}</td>
                        <td class="text-capitalize">{{ $attendanceList->user->user_data->position->position }}</td>
                        <td>{{ date('F', mktime(0, 0, 0, $attendanceList->month, 10)) }}</td>
                        <td>{{ $attendanceList->year }}</td>
                        <td>
                            <a href="{{ route('karyawan.slip-gaji.show', ['attendanceList' => $attendanceList]) }}" class="btn btn-sm btn-success border-0" target="_blank" title="Download">
                                <i class="fa-solid fa-sm fa-fw fa-download me-1"></i>Download
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center align-middle">
                        <td colspan="7">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $attendanceLists->links() }}
    </div>
</div>
@endsection