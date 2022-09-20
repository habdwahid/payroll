@extends('dashboard.layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Data Karyawan</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Karyawan</h6>
    </div>
    <div class="card-body px-lg-4">
        <form action="{{ route('admin.karyawan.store') }}" method="post">
            @csrf
            <div class="mb-2">
                <label for="nik" class="form-label">NIK</label>
                <input type="number" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" required>
                @error('nik')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-control text-capitalize @error('name') is-invalid @enderror" value="{{ old('name') }}" maxlength="128" required>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control text-lowercase @error('email') is-invalid @enderror" value="{{ old('email') }}" maxlength="64" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="row mb-2">
                <div class="col-lg">
                    <label for="position" class="form-label">Jabatan</label>
                    <select name="position" id="position" class="form-select text-muted @error('position') is-invalid @enderror" required>
                        <option value="">-</option>
                        @forelse ($positions as $position)
                        <option value="{{ $position->id }}" @selected( old('position')==$position->id )>{{ $position->position }}</option>
                        @empty
                        @endforelse
                    </select>
                    @error('position')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="col-lg">
                    <label for="sex" class="form-label">Jenis Kelamin</label>
                    <select name="sex" id="sex" class="form-select text-muted @error('sex') is-invalid @enderror" required>
                        <option value="">-</option>
                        <option value="Laki-Laki" @selected( old('sex')=='Laki-Laki' )>Laki-Laki</option>
                        <option value="Perempuan" @selected( old('sex')=='Perempuan' )>Perempuan</option>
                    </select>
                    @error('sex')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 digit" minlength="6" required>
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
@endsection