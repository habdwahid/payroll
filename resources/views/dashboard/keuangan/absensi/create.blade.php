@extends('dashboard.layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rekap Absensi</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Rekap Absensi</h6>
    </div>
    <div class="card-body px-lg-4">
        <form action="{{ route('keuangan.absensi.store') }}" method="post">
            @csrf
            <div class="row justify-content-center mb-3">
                <div class="col-lg">
                    <label for="month" class="form-label">Bulan</label>
                    <select name="month" id="month" class="form-select form-select-sm text-muted" required>
                        <option value="">-</option>
                        <option value="{{ date('m', strtotime('-1 month')) }}">{{ date('F', strtotime('-1 month')) }}</option>
                        <option value="{{ date('m') }}">{{ date('F') }}</option>
                    </select>
                </div>
                <div class="col-lg">
                    <label for="year" class="form-label">Tahun</label>
                    <input type="number" name="year" id="year" class="form-control form-control-sm" value="{{ date('Y') }}" min="{{ date('Y') }}" max="{{ date('Y') }}" disabled>
                </div>
            </div>
            <div class="table-responsive">
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
                        @forelse ($users as $user)
                        <tr class="text-center align-middle">
                            <td>{{ $user->nik }}</td>
                            <td class="text-capitalize text-start">{{ $user->name }}</td>
                            <td>{{ $user->user_data->sex }}</td>
                            <td>
                                <input type="hidden" name="user[]" id="user" value="{{ $user->id }}">
                                <input type="number" name="present[]" id="present" class="form-control form-control-sm" min="0" value="0">
                            </td>
                            <td>
                                <input type="number" name="permission[]" id="permission" class="form-control form-control-sm" min="0" value="0">
                            </td>
                            <td>
                                <input type="number" name="sick[]" id="sick" class="form-control form-control-sm" min="0" value="0">
                            </td>
                            <td>
                                <input type="number" name="absent[]" id="absent" class="form-control form-control-sm" min="0" value="0">
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
            <div class="text-end">
                <a href="{{ route('keuangan.absensi.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Rekap</button>
            </div>
        </form>
    </div>
</div>
@endsection