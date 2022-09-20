<?php

namespace App\Http\Controllers\Dashboard\Pimpinan;

use Illuminate\Http\Request;
use App\Models\AttendanceList;
use App\Http\Controllers\Controller;
use App\Models\SalaryCuts;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
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
    public function absensi()
    {
        $attendanceList = $this->attendanceList
            ->with(['user']);

        if (request('month')) {
            $attendanceList = $attendanceList
                ->where('month', request('month'))
                ->where('year', request('year'));
        } else {
            $attendanceList = $attendanceList
                ->where('month', date('m'))
                ->where('year', date('Y'));
        }

        $title = 'Laporan Absensi';
        $attendanceLists = $attendanceList
            ->paginate(10);

        return view('dashboard.pimpinan.laporan.absensi.index', compact('title', 'attendanceLists'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gaji()
    {
        $attendanceList = $this->attendanceList
            ->with(['user']);

        if (request('month')) {
            $attendanceList = $attendanceList
                ->where('month', request('month'))
                ->where('year', request('year'));
        } else {
            $attendanceList = $attendanceList
                ->where('month', date('m'))
                ->where('year', date('Y'));
        }

        $title = 'Laporan Gaji';
        $attendanceLists = $attendanceList
            ->paginate(10);
        $absent = $this->salaryCuts
            ->where('attendance', 'Absen')
            ->first();
        $permission = $this->salaryCuts
            ->where('attendance', 'Izin')
            ->first();
        $sick = $this->salaryCuts
            ->where('attendance', 'Sakit')
            ->first();

        return view('dashboard.pimpinan.laporan.gaji.index', compact('title', 'attendanceLists', 'absent', 'permission', 'sick'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function absensiPdf($month, $year)
    {
        $attendanceList = $this->attendanceList
            ->with(['user'])
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        $title = $month . $year . '_' . 'laporan_absensi.pdf';

        $pdf = Pdf::loadView('dashboard.pimpinan.laporan.absensi.absensi', compact('title', 'attendanceList', 'month', 'year'))
            ->setPaper('legal', 'landscape');

        return $pdf->stream($title);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gajiPdf($month, $year)
    {
        $attendanceList = $this->attendanceList
            ->with(['user'])
            ->where('month', $month)
            ->where('year', $year)
            ->get();

        $title = $month . $year . '_' . 'laporan_gaji.pdf';
        $absent = $this->salaryCuts
            ->where('attendance', 'Absen')
            ->first();
        $permission = $this->salaryCuts
            ->where('attendance', 'Izin')
            ->first();
        $sick = $this->salaryCuts
            ->where('attendance', 'Sakit')
            ->first();

        $pdf = Pdf::loadView('dashboard.pimpinan.laporan.gaji.gaji', compact('title', 'attendanceList', 'month', 'year', 'absent', 'permission', 'sick'))
            ->setPaper('legal', 'landscape');

        return $pdf->stream($title);
    }
}
