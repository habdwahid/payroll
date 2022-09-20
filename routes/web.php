<?php

use App\Http\Controllers\Dashboard\Admin\PositionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\Karyawan\SalarySlipController;
use App\Http\Controllers\Dashboard\Keuangan\AttendanceListController;
use App\Http\Controllers\Dashboard\Keuangan\SalaryController;
use App\Http\Controllers\Dashboard\Keuangan\SalaryCutsController;
use App\Http\Controllers\Dashboard\Pimpinan\ReportController;
use App\Http\Controllers\Dashboard\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('reset-password', [ResetPasswordController::class, 'index'])
        ->name('reset-password.index');

    Route::put('reset-password/{user}', [ResetPasswordController::class, 'update'])
        ->name('reset-password.update');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('admin/karyawan', 'index')
            ->name('admin.karyawan.index');

        Route::get('admin/karyawan/create', 'create')
            ->name('admin.karyawan.create');

        Route::post('admin/karyawan/create', 'store')
            ->name('admin.karyawan.store');

        Route::get('admin/karyawan/{user}/edit', 'edit')
            ->name('admin.karyawan.edit');

        Route::put('admin/karyawan/{user}', 'update')
            ->name('admin.karyawan.update');

        Route::delete('admin/karyawan/{user}', 'destroy')
            ->name('admin.karyawan.destroy');
    });

    Route::controller(PositionController::class)->group(function () {
        Route::get('admin/jabatan', 'index')
            ->name('admin.jabatan.index');

        Route::post('admin/jabatan/create', 'store')
            ->name('admin.jabatan.store');

        Route::put('admin/jabatan/{position}', 'update')
            ->name('admin.jabatan.update');

        Route::delete('admin/jabatan/{position}', 'destroy')
            ->name('admin.jabatan.destroy');
    });
});

Route::middleware(['auth', 'verified', 'role:pimpinan'])->group(function () {
    Route::controller(ReportController::class)->group(function () {
        Route::get('laporan/absensi', 'absensi')
            ->name('pimpinan.absensi.index');

        Route::get('laporan/gaji', 'gaji')
            ->name('pimpinan.gaji.index');

        Route::get('laporan/absensi/{month}/{year}', 'absensiPdf')
            ->name('pimpinan.absensi.pdf');

        Route::get('laporan/gaji/{month}/{year}', 'gajiPdf')
            ->name('pimpinan.gaji.pdf');
    });
});

Route::middleware(['auth', 'verified', 'role:keuangan'])->group(function () {
    Route::controller(SalaryController::class)->group(function () {
        Route::get('keuangan/gaji', 'index')
            ->name('keuangan.gaji.index');

        Route::put('keuangan/gaji/{salary}', 'update')
            ->name('keuangan.gaji.update');

        Route::delete('keuangan/gaji/{salary}', 'destroy')
            ->name('keuangan.gaji.destroy');
    });

    Route::controller(SalaryCutsController::class)->group(function () {
        Route::get('keuangan/potongan-gaji', 'index')
            ->name('keuangan.potongan-gaji.index');

        Route::put('keuangan/potongan-gaji/{salaryCuts}', 'update')
            ->name('keuangan.potongan-gaji.update');

        Route::delete('keuangan/potongan-gaji/{salaryCuts}', 'destroy')
            ->name('keuangan.potongan-gaji.destroy');
    });

    Route::controller(AttendanceListController::class)->group(function () {
        Route::get('keuangan/absensi', 'index')
            ->name('keuangan.absensi.index');

        Route::get('keuangan/absensi/create', 'create')
            ->name('keuangan.absensi.create');

        Route::post('keuangan/absensi/create', 'store')
            ->name('keuangan.absensi.store');

        Route::get('keuangan/absensi/{attendanceList}/edit', 'edit')
            ->name('keuangan.absensi.edit');

        Route::put('keuangan/absensi/{attendanceList}', 'update')
            ->name('keuangan.absensi.update');
    });
});

Route::middleware(['auth', 'verified', 'role:karyawan'])->group(function () {
    Route::controller(SalarySlipController::class)->group(function () {
        Route::get('/', 'index')
            ->name('karyawan.slip-gaji.index');

        Route::get('slip-gaji/{attendanceList}', 'show')
            ->name('karyawan.slip-gaji.show');
    });
});

require __DIR__ . '/auth.php';
