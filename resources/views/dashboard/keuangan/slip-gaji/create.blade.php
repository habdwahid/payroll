@extends('dashboard.layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Buat Slip Gaji</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 fw-bold text-primary">Buat Slip Gaji</h6>
    </div>
    <div class="card-body px-lg-4">
        <form action="{{ route('keuangan.slip-gaji.store') }}" method="post">
            @csrf
        </form>
    </div>
</div>
@endsection