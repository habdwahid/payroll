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
            <form action="{{ route('login') }}" method="post" class="user">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-user @error('login') is-invalid @enderror" name="login" id="login" value="{{ old('login') }}" placeholder="NIK atau Email" required>
                    @error('login')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember" value="true" checked>
                        <label class="custom-control-label" for="remember">Remember Me</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('password.request') }}">Lupa Password?</a>
            </div>
        </div>
    </div>
</div>
@endsection