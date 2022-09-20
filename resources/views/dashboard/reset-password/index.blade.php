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
    <h1 class="h3 mb-0 text-gray-800">Ubah Password</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body px-lg-4">
        <form action="{{ route('reset-password.update', ['user' => auth()->id()]) }}" method="post">
            @method('put')
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="mb-2">
                        <label for="old" class="form-label">Password Lama</label>
                        <input type="password" name="old" id="old" class="form-control @error('old') is-invalid @enderror" required>
                        @error('old')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" minlength="6" required>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection