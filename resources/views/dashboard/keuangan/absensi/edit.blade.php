@extends('dashboard.layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Update Absensi</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 fw-bold text-primary">Update Absensi</h6>
    </div>
    <div class="card-body px-lg-4">
        <form action="{{ route('keuangan.absensi.update', ['attendanceList' => $attendanceList]) }}" method="post">
            <div class="table-responsive">
                @method('put')
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center align-middle">
                            <th class="col-2" scope="col">NIK</th>
                            <th class="col-4" scope="col">Nama</th>
                            <th class="col-2" scope="col">Jenis Kelamin</th>
                            <th class="col-1" scope="col">Hadir</th>
                            <th class="col-1" scope="col">Izin</th>
                            <th class="col-1" scope="col">Sakit</th>
                            <th class="col-1" scope="col">Absen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center align-middle">
                            <td>{{ $attendanceList->user->nik }}</td>
                            <td class="text-capitalize text-start">{{ $attendanceList->user->name }}</td>
                            <td>{{ $attendanceList->user->user_data->sex }}</td>
                            <td>
                                <input type="number" name="present" id="present" class="form-control form-control-sm" min="0" value="{{ old('present', $attendanceList->present) }}">
                            </td>
                            <td>
                                <input type="number" name="permission" id="permission" class="form-control form-control-sm" min="0" value="{{ old('permission', $attendanceList->has_permission) }}">
                            </td>
                            <td>
                                <input type="number" name="sick" id="sick" class="form-control form-control-sm" min="0" value="{{ old('sick', $attendanceList->sick) }}">
                            </td>
                            <td>
                                <input type="number" name="absent" id="absent" class="form-control form-control-sm" min="0" value="{{ old('absent', $attendanceList->absent) }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-end">
                <a href="{{ route('keuangan.absensi.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection