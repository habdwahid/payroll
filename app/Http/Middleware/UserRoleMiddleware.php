<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($request->user()->user_role->role->role != $role) {
            switch ($request->user()->user_role->role->role) {
                case 'admin':
                    return to_route('admin.karyawan.index');
                    break;

                case 'pimpinan':
                    return to_route('pimpinan.absensi.index');
                    break;

                case 'keuangan':
                    return to_route('keuangan.absensi.index');
                    break;

                default:
                    return to_route('karyawan.slip-gaji.index');
                    break;
            }
        }

        return $next($request);
    }
}
