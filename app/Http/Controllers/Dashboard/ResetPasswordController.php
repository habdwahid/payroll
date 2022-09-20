<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Ubah Password';

        return view('dashboard.reset-password.index', compact('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'old' => ['required'],
            'password' => ['required', 'confirmed', 'string', 'min:6'],
            'password_confirmation' => ['required']
        ]);

        if (!Hash::check($request->old, $user->password)) {
            throw ValidationException::withMessages(['old' => __('auth.password')]);
        }

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        return back()
            ->with(['status' => 'Password Berhasil Diubah']);
    }
}
