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
    <h1 class="h3 mb-0 text-gray-800">Potongan Gaji</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Potongan Gaji</h6>
    </div>
    <div class="card-body px-lg-4">
        <form method="post" id="salaryForm">
            @method('put')
            @csrf
            <div class="row justify-content-center mb-2">
                <div class="col-lg">
                    <label for="attendance" class="form-label">Daftar Hadir</label>
                    <select name="attendance" id="attendance" class="form-select text-muted" required>
                        <option value="">-</option>
                        @forelse ($salaryCuts->where('salary_cuts', null) as $salary)
                        <option value="{{ $salary->id }}">{{ $salary->attendance }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-lg">
                    <label for="salary" class="form-label">Potongan Gaji</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" name="salary" id="salary" class="form-control" minlength="6" maxlength="9" required>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-fw fa-table me-1"></i>Data Potongan Gaji</h6>
    </div>
    <div class="card-body px-lg-4">
        <div class="d-flex justify-content-end mb-3">
            <form action="{{ route('keuangan.gaji.index') }}" method="get">
                @csrf
                <div class="d-flex justify-content-center align-items-center gap-2">
                    <label for="search" class="my-auto">Search</label>
                    <input type="text" name="search" id="search" class="form-control form-control-sm" value="{{ request('search') }}">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="col-1" scope="col">#</th>
                        <th class="col-7" scope="col">Kehadiran</th>
                        <th class="col-3" scope="col">Potongan</th>
                        <th class="col-1" scope="col"><i class="fa-solid fa-fw fa-screwdriver-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salaryCuts as $salary)
                    <tr class="text-center align-middle">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td data-attr="attendance">{{ $salary->attendance }}</td>
                        <td class="text-end" data-attr="salary">{{ 'Rp. ' . number_format($salary->salary_cuts) }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-primary border-0" title="Update" data-attr="{{ $salary->id }}"><i class="fa-solid fa-sm fa-fw fa-square-pen"></i></button>
                                <button type="button" class="btn btn-sm btn-danger border-0" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-attr="{{ $salary->id }}"><i class="fa-solid fa-sm fa-fw fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center align-middle">
                        <td colspan="4">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda yakin ingin menghapus potongan gaji <span class="fw-semibold" id="name"></span>?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                <form method="post" id="deleteForm">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Create Method
        $("#attendance").change(function() {
            let id = $(this).val();

            $("#salaryForm").attr("action", "{{ url('keuangan/potongan-gaji') }}/" + id);
        });

        // Update Method
        $('button[title="Update"]').click(function() {
            let id = $(this).attr("data-attr");

            $("#salaryForm").attr("action", "{{ url('keuangan/potongan-gaji') }}/" + id);
            $("#attendance").empty().append('<option value="' + id + '">' + $(this).parents().siblings('td[data-attr="attendance"]').html() + '</option>').attr("disabled", "disabled");
            $('button[type="submit"]').text("Update");
        });

        // Delete Method
        $('button[title="Hapus"').click(function() {
            let id = $(this).attr("data-attr");

            $("#name").html($(this).parents().siblings('td[data-attr="attendance"]').html());
            $("#deleteForm").attr("action", "{{ url('keuangan/potongan-gaji') }}/" + id);
        });
    });
</script>
@endsection