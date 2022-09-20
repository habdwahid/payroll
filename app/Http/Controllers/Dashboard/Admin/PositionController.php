<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    protected $position;

    public function __construct()
    {
        $this->position = new Position();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Jabatan';
        $positions = $this->position
            ->search(request('search'))
            ->paginate(10);

        return view('dashboard.admin.jabatan.index', compact('title', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'position' => ['required', 'string', 'max:64'],
        ]);

        $this->position->create([
            'position' => $request->position,
        ]);

        return back()
            ->with(['status' => 'Data Jabatan Berhasil Ditambah']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'position' => ['required', 'string', 'max:64'],
        ]);

        $position->update([
            'position' => $request->position,
        ]);

        return back()
            ->with(['status' => 'Data Jabatan Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return back()
            ->with(['status' => 'Data Jabatan Berhasil Dihapus']);
    }
}
