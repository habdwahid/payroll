<?php

namespace App\Http\Controllers\Dashboard\Keuangan;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Position;

class SalaryController extends Controller
{
    protected $position;

    protected $salary;

    public function __construct()
    {
        $this->position = new Position();

        $this->salary = new Salary();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = $this->salary
            ->where('salary', null)
            ->get('position_id')
            ->toArray();

        $title = 'Data Gaji';
        $positions = $this->position
            ->whereIn('id', $values)
            ->orderBy('position', 'asc')
            ->cursor();
        $salaries = $this->salary
            ->search(request('search'))
            ->paginate(10);

        return view('dashboard.keuangan.gaji.index', compact('title', 'positions', 'salaries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'salary' => ['required'],
            'meal' => ['required'],
            'transport' => ['required'],
        ]);

        $salary->update([
            'salary' => $request->salary,
            'meal_allowance' => $request->meal,
            'transport_allowance' => $request->transport,
        ]);

        return back()
            ->with(['status' => 'Data Gaji Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        $salary->update([
            'salary' => null,
            'meal_allowance' => null,
            'transport_allowance' => null,
        ]);

        return back()
            ->with(['status' => 'Data Gaji Berhasil Dihapus']);
    }
}
