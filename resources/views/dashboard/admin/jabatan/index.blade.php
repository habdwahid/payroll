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
    <h1 class="h3 mb-0 text-gray-800">Jabatan</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary" id="positionHeading">Tambah Data Jabatan</h6>
    </div>
    <div class="card-body px-lg-4">
        <form action="{{ route('admin.jabatan.store') }}" method="post" id="positionForm">
            @csrf
            <div class="mb-2">
                <label for="position" class="form-label">Jabatan</label>
                <input type="text" name="position" id="position" class="form-control text-capitalize @error('position') is-invalid @enderror" value="{{ old('position') }}">
                @error('position')
                <div class="invalid-feedback">
                    {{ $meesage }}
                </div>
                @enderror
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-fw fa-table me-1"></i>Data Jabatan</h6>
    </div>
    <div class="card-body px-lg-4">
        <div class="d-flex justify-content-end mb-3">
            <form action="{{ route('admin.jabatan.index') }}" method="get">
                @csrf
                <div class="d-flex gap-2">
                    <label for="search" class="my-auto">Search</label>
                    <input type="text" name="search" id="search" class="form-control form-control-sm" value="{{ request('search') }}" maxlength="64">
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center align-middle">
                        <th class="col-1" scope="col">#</th>
                        <th class="col-10" scope="col">Jabatan</th>
                        <th class="col-1" scope="col"><i class="fa-solid fa-fw fa-screwdriver-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($positions as $position)
                    <tr class="text-center align-middle">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td class="text-capitalize" data-attr="name">{{ $position->position }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <button type="button" class="btn btn-sm btn-primary border-0" title="Update" data-attr="{{ $position->id }}"><i class="fa-solid fa-sm fa-fw fa-square-pen"></i></button>
                                <button type="button" class="btn btn-sm btn-danger border-0" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-attr="{{ $position->id }}"><i class="fa-solid fa-sm fa-fw fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center my-auto">
                        <td colspan="3">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $positions->links() }}
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
            <div class="modal-body">Anda yakin ingin menghapus <span class="fw-semibold" id="name"></span>?</div>
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
        // Update Method
        $('button[title="Update"]').click(function() {
            let id = $(this).attr("data-attr");

            $("#position").val($(this).parents().siblings('td[data-attr="name"]').html());
            $('button[type="submit"]').text("Update");
            $("#positionForm").attr("action", "{{ url('admin/jabatan') }}/" + id).append('<input type="hidden" name="_method" value="put">');
            $("#positionHeading").html("Update Data Jabatan");
        });

        // Delete Method
        $('button[title="Hapus"').click(function() {
            let id = $(this).attr("data-attr");

            $("#name").html($(this).parents().siblings('td[data-attr="name"]').html());
            $("#deleteForm").attr("action", "{{ url('admin/jabatan') }}/" + id);
        });
    });
</script>
@endsection