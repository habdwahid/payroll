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
    <h1 class="h3 mb-0 text-gray-800">Data Karyawan</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-fw fa-table me-1"></i>Data Karyawan</h6>
    </div>
    <div class="card-body px-lg-4">
        <div class="d-flex justify-content-end align-items-center mb-3">
            <form action="{{ route('admin.karyawan.index') }}" method="get" id="searchForm">
                @csrf
                <div class="d-flex justify-content-center gap-2">
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
                        <th class="col-2" scope="col">NIK</th>
                        <th class="col-5" scope="col">Nama</th>
                        <th class="col-3" scope="col">Jabatan</th>
                        <th class="col-1" scope="col"><i class="fa-solid fa-fw fa-screwdriver-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr class="text-center align-middle">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $user->nik }}</td>
                        <td class="text-capitalize" data-attr="name">{{ $user->name }}</td>
                        <td>{{ $user->user_data->position->position }}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                <a href="{{ route('admin.karyawan.edit', ['user' => $user]) }}" class="btn btn-sm btn-primary border-0" title="Update"><i class="fa-solid fa-sm fa-fw fa-square-pen"></i></a>
                                <button type="button" class="btn btn-sm btn-danger border-0" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-attr="{{ $user->id }}"><i class="fa-solid fa-sm fa-fw fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center align-middle">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $users->links() }}
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
        // Delete Method
        $('button[title="Hapus"').click(function() {
            let id = $(this).attr("data-attr");

            $("#name").html($(this).parents().siblings('td[data-attr="name"]').html());
            $("#deleteForm").attr("action", "{{ url('admin/karyawan') }}/" + id + "/force-delete");
        });
    });
</script>
@endsection