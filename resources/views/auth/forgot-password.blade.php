@extends('auth.layouts.app')

@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="p-4">
            <div class="text-center">
                <img src="{{ asset('assets/img/cita-mandiri.png') }}" alt="CV. Cita Mandiri" style="width: 60px;">
                <h1 class="h4 text-gray-900 mb-4">CV. Cita Mandiri</h1>
            </div>
            <hr class="text-muted">
            @if (session()->has('status'))
            <div class="alert alert-success fade show" role="alert">
                <i class="fa-solid fa-fw fa-circle-check me-1"></i>{{ session('status') }}
            </div>
            @endif
            <form action="{{ route('password.email') }}" method="post" class="user">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Kirim</button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
</div>
@endsection