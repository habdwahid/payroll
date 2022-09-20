<?php

namespace App\Http\Controllers\Dashboard\Karyawan;

use Illuminate\Http\Request;
use App\Models\AttendanceList;
use App\Http\Controllers\Controller;
use App\Models\SalaryCuts;
use Barryvdh\DomPDF\Facade\Pdf;

class SalarySlipController extends Controller
{
    protected $attendanceList;

    protected $salaryCuts;

    public function __construct()
    {
        $this->attendanceList = new AttendanceList();

        $this->salaryCuts = new SalaryCuts();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendanceList = $this->attendanceList
            ->with(['user'])
            ->where('user_id', auth()->id());

        $title = 'Slip Gaji';

        if (request('month')) {
            $attendanceLists = $attendanceList
                ->where('month', request('month'))
                ->where('year', request('year'));
        } else {
            $attendanceLists = $attendanceList
                ->where('month', date('m'))
                ->where('year', date('Y'));
        }

        $attendanceLists = $attendanceLists
            ->paginate(10);

        return view('dashboard.karyawan.slip-gaji.index', compact('title', 'attendanceLists'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttendanceList  $attendanceList
     * @return \Illuminate\Http\Response
     */
    public function show(AttendanceList $attendanceList)
    {
        $title = $attendanceList->month . $attendanceList->year . '_' . $attendanceList->user->name . '.pdf';
        $absent = $this->salaryCuts
            ->where('attendance', 'Absen')
            ->first();
        $penerimaan = $attendanceList->user->user_data->position->salary->salary + $attendanceList->user->user_data->position->salary->meal_allowance + $attendanceList->user->user_data->position->salary->transport_allowance;
        $permission = $this->salaryCuts
            ->where('attendance', 'Izin')
            ->first();
        $sick = $this->salaryCuts
            ->where('attendance', 'Sakit')
            ->first();

        if ($attendanceList->absent != 0) {
            $absent = $absent->salary_cuts * $attendanceList->absent;
        } else {
            $absent = 0;
        }

        if ($attendanceList->has_permission != 0) {
            $permission = $permission->salary_cuts * $attendanceList->has_permission;
        } else {
            $permission = 0;
        }

        if ($attendanceList->sick != 0) {
            $sick = $sick->salary_cuts * $attendanceList->sick;
        } else {
            $sick = 0;
        }

        $potongan = $absent + $permission + $sick;

        $pdf = Pdf::loadView('dashboard.karyawan.slip-gaji.show', compact('title', 'attendanceList', 'absent', 'penerimaan', 'permission', 'potongan', 'sick'))
            ->setPaper('a5', 'landscape');

        return $pdf->stream($title);
    }
}
