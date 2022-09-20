<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <span class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/cita-mandiri.png') }}" alt="CV. Cita Mandiri" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-3">CV. Cita Mandiri</div>
    </span>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @can('admin')
    <!-- Nav Item - Karyawan -->
    <li class="nav-item @if (request()->is('admin/karyawan*')) active @endif">
        <button type="button" class="nav-link collapsed bg-transparent border-0" data-bs-toggle="collapse" data-bs-target="#collapseKaryawan" aria-expanded="true" aria-controls="collapseKaryawan">
            <i class="fa-solid fa-fw fa-users"></i>
            <span>Karyawan</span>
        </button>
        <div id="collapseKaryawan" class="collapse @if (request()->is('admin/karyawan*')) show @endif" aria-labelledby="headingKaryawan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if (request()->routeIs('admin.karyawan.index')) active @endif" href="{{ route('admin.karyawan.index') }}">Data Karyawan</a>
                <a class="collapse-item @if (request()->routeIs('admin.karyawan.create', 'admin.karyawan.store')) active @endif" href="{{ route('admin.karyawan.create') }}">Tambah Data</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Jabatan -->
    <li class="nav-item @if (request()->is('admin/jabatan*')) active @endif">
        <a class="nav-link" href="{{ route('admin.jabatan.index') }}">
            <i class="fa-solid fa-fw fa-list"></i>
            <span>Jabatan</span></a>
    </li>
    @endcan

    @can('pimpinan')
    <!-- Nav Item - Laporan -->
    <li class="nav-item @if (request()->is('laporan*')) active @endif">
        <button type="button" class="nav-link collapsed bg-transparent border-0" data-bs-toggle="collapse" data-bs-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
            <i class="fa-solid fa-fw fa-users"></i>
            <span>Laporan</span>
        </button>
        <div id="collapseLaporan" class="collapse @if (request()->is('laporan*')) show @endif" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if (request()->routeIs('pimpinan.absensi.index')) active @endif" href="{{ route('pimpinan.absensi.index') }}">Laporan Absensi</a>
                <a class="collapse-item @if (request()->routeIs('pimpinan.gaji.index')) active @endif" href="{{ route('pimpinan.gaji.index') }}">Laporan Gaji</a>
            </div>
        </div>
    </li>
    @endcan

    @can('keuangan')
    <!-- Nav Item - Gaji -->
    <li class="nav-item @if (request()->is('keuangan/gaji*', 'keuangan/potongan-gaji*')) active @endif">
        <button type="button" class="nav-link collapsed bg-transparent border-0" data-bs-toggle="collapse" data-bs-target="#collapseGaji" aria-expanded="true" aria-controls="collapseGaji">
            <i class="fa-solid fa-fw fa-rupiah-sign"></i>
            <span>Gaji</span>
        </button>
        <div id="collapseGaji" class="collapse @if (request()->is('keuangan/gaji*', 'keuangan/potongan-gaji*')) show @endif" aria-labelledby="headingGaji" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if (request()->routeIs('keuangan.gaji.index')) active @endif" href="{{ route('keuangan.gaji.index') }}">Data Gaji</a>
                <a class="collapse-item @if (request()->routeIs('keuangan.potongan-gaji.index')) active @endif" href="{{ route('keuangan.potongan-gaji.index') }}">Potongan Gaji</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Absensi -->
    <li class="nav-item @if (request()->is('keuangan/absensi*')) active @endif">
        <a class="nav-link" href="{{ route('keuangan.absensi.index') }}">
            <i class="fa-solid fa-fw fa-file-pen"></i>
            <span>Data Absensi</span></a>
    </li>
    @endcan

    @can('karyawan')
    <!-- Nav Item - Slip Gaji -->
    <li class="nav-item @if (request()->routeIs('karyawan.slip-gaji.index')) active @endif">
        <a class="nav-link" href="{{ route('karyawan.slip-gaji.index') }}">
            <i class="fa-solid fa-fw fa-file-invoice-dollar"></i>
            <span>Slip Gaji</span></a>
    </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>