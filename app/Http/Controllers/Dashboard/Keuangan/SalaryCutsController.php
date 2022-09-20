<?php

namespace App\Http\Controllers\Dashboard\Keuangan;

use App\Models\SalaryCuts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryCutsController extends Controller
{
    protected $salaryCuts;

    public function __construct()
    {
        $this->salaryCuts = new SalaryCuts();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Potongan Gaji';
        $salaryCuts = $this->salaryCuts
            ->orderBy('attendance', 'asc')
            ->get();

        return view('dashboard.keuangan.potongan-gaji.index', compact('title', 'salaryCuts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalaryCuts  $salaryCuts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalaryCuts $salaryCuts)
    {
        $request->validate([
            'salary' => ['required']
        ]);

        $salaryCuts->update([
            'salary_cuts' => $request->salary,
        ]);

        return back()
            ->with(['status' => 'Data Potongan Gaji Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryCuts  $salaryCuts
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryCuts $salaryCuts)
    {
        $salaryCuts->update([
            'salary_cuts' => null,
        ]);

        return back()
            ->with(['status' => 'Data Potongan Gaji Berhasil Dihapus']);
    }
}
