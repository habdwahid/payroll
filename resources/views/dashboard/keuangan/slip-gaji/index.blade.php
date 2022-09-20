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
    <h1 class="h3 mb-0 text-gray-800">Slip Gaji</h1>
</div>

<div class="text-end mb-3">
    <a href="{{ route('keuangan.slip-gaji.create') }}" class="btn btn-primary">Buat Slip Gaji</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-fw fa-table me-1"></i>Data Slip Gaji</h6>
    </div>
    <div class="card-body px-lg-4">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center align-middle"></tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection