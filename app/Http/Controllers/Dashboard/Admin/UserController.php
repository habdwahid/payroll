<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\UserStoreRequest;
use App\Http\Requests\Dashboard\Admin\UserUpdateRequest;
use App\Models\UserRole;

class UserController extends Controller
{
    protected $position;

    protected $user;

    protected $user_role;

    public function __construct()
    {
        $this->position = new Position();

        $this->user = new User();

        $this->user_role = new UserRole();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $values = $this->user_role
            ->where('role_id', '!=', 1)
            ->get('user_id')
            ->toArray();

        $title = 'Data Karyawan';
        $users = $this->user->search(request('search'))
            ->whereIn('id', $values)
            ->paginate(10);

        return view('dashboard.admin.karyawan.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $title = 'Tambah Data Karyawan';
        $positions = $this->position
            ->orderBy('position', 'asc')
            ->cursor();

        return view('dashboard.admin.karyawan.create', compact('title', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Dashboard\Admin\UserStoreRequest  $request
     * @return \Illuminate\Http\ReidrectResponse
     */
    public function store(UserStoreRequest $request)
    {
        $request->store();

        return to_route('admin.karyawan.index')
            ->with(['status' => 'Data Karyawan Berhasil Ditambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        $title = 'Update Data Karyawan';
        $positions = $this->position
            ->orderBy('position', 'asc')
            ->cursor();

        return view('dashboard.admin.karyawan.edit', compact('title', 'positions', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Dashboard\Admin\UserUpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $request->update($user);

        return to_route('admin.karyawan.index')
            ->with(['status' => 'Data Karyawan Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()
            ->with(['status' => 'Data Karyawan Berhasil Dihapus']);
    }
}
