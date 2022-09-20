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
    <h1 class="h3 mb-0 text-gray-800">Data Gaji</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Gaji</h6>
    </div>
    <div class="card-body px-lg-4">
        <form method="post" id="salaryForm">
            @method('put')
            @csrf
            <div class="row justify-content-center mb-2">
                <div class="col-lg">
                    <label for="position" class="form-label">Jabatan</label>
                    <select name="position" id="position" class="form-select text-muted" required>
                        <option value="">-</option>
                        @forelse ($positions as $position)
                        <option value="{{ $position->id }}">{{ $position->position }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-lg">
                    <label for="salary" class="form-label">Gaji Pokok</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" name="salary" id="salary" class="form-control" minlength="6" maxlength="9" required>
                    </div>
                </div>
                <div class="col-lg">
                    <label for="meal" class="form-label">Tunjangan Makan</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" name="meal" id="meal" class="form-control" minlength="6" maxlength="9" required>
                    </div>
                </div>
                <div class="col-lg">
                    <label for="transport" class="form-label">Tunjangan Transport</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" name="transport" id="transport" class="form-control" minlength="6" maxlength="9" required>
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
        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-fw fa-table me-1"></i>Data Gaji</h6>
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
                        <th class="col-3" scope="col">Jabatan</th>
                        <th class="col-2" scope="col">Gaji Pokok</th>
                        <th class="col-2" scope="col">Tunjangan Makan</th>
                        <th class="col-2" scope="col">Tunjangan Transport</th>
                        <th class="col-1" scope="col"><i class="fa-solid fa-fw fa-screwdriver-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salaries as $salary)
                    <tr class="text-center align-middle">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td data-attr="position">{{ $salary->position->position }}</td>
                        <td class="text-end">{{ 'Rp. ' . number_format($salary->salary) }}</td>
                        <td class="text-end">{{ 'Rp. ' . number_format($salary->meal_allowance) }}</td>
                        <td class="text-end">{{ 'Rp. ' . number_format($salary->transport_allowance) }}</td>
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
        {{ $salaries->links() }}
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
            <div class="modal-body">Anda yakin ingin menghapus gaji <span class="fw-semibold" id="name"></span>?</div>
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
        $("#position").change(function() {
            let id = $(this).val();

            $("#salaryForm").attr("action", "{{ url('keuangan/gaji') }}/" + id);
        });

        // Update Method
        $('button[title="Update"]').click(function() {
            let id = $(this).attr("data-attr");

            $("#salaryForm").attr("action", "{{ url('keuangan/gaji') }}/" + id);
            $("#position").empty().append('<option value="' + id + '">' + $(this).parents().siblings('td[data-attr="position"]').html() + '</option>').attr("disabled", "disabled");
            $('button[type="submit"]').text("Update");
        });

        // Delete Method
        $('button[title="Hapus"').click(function() {
            let id = $(this).attr("data-attr");

            $("#name").html($(this).parents().siblings('td[data-attr="position"]').html());
            $("#deleteForm").attr("action", "{{ url('keuangan/gaji') }}/" + id);
        });
    });
</script>
@endsection