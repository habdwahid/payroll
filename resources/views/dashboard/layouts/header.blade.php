<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <h3 class="fw-light my-auto"><span class="text-warning">Payroll</span> <span class="text-primary">Information System</span></h3>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <button type="button" class="nav-link dropdown-toggle bg-transparent border-0" id="userDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ ((auth()->user()->user_data->sex === 'Laki-Laki') ? asset('assets/img/undraw_profile_2.svg') : asset('assets/img/undraw_profile_3.svg')) }}">
            </button>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('reset-password.index') }}">
                    <i class="fa-solid fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="fa-solid fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Keluar
                </button>
            </div>
        </li>

    </ul>

</nav>