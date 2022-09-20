<?php

namespace App\Http\Controllers\Dashboard\Keuangan;

use Illuminate\Http\Request;
use App\Models\AttendanceList;
use App\Http\Controllers\Controller;
use App\Models\User;

class AttendanceListController extends Controller
{
    protected $attendanceList;

    protected $user;

    public function __construct()
    {
        $this->attendanceList = new AttendanceList();

        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendanceList = $this->attendanceList
            ->with(['user']);

        if (request('month')) {
            $attendanceLists = $attendanceList
                ->where('month', request('month'))
                ->where('year', request('year'));
        } else {
            $attendanceLists = $attendanceList
                ->where('month', date('m'))
                ->where('year', date('Y'));
        }

        $title = 'Data Absensi';
        $attendanceLists = $attendanceLists
            ->paginate(10);

        return view('dashboard.keuangan.absensi.index', compact('title', 'attendanceLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Rekap Absensi';
        $users = $this->user
            ->with(['user_data'])
            ->cursor();

        return view('dashboard.keuangan.absensi.create', compact('title', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->present as $i => $value) {
            $this->attendanceList->create([
                'user_id' => $request->user[$i],
                'month' => $request->month,
                'year' => $request->year,
                'present' => $value,
                'has_permission' => $request->permission[$i],
                'sick' => $request->sick[$i],
                'absent' => $request->absent[$i],
            ]);
        }

        return to_route('keuangan.absensi.index')
            ->with(['status' => 'Absensi Berhasil Direkap']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttendanceList  $attendanceList
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendanceList $attendanceList)
    {
        $title = 'Update Absensi';

        return view('dashboard.keuangan.absensi.edit', compact('title', 'attendanceList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttendanceList  $attendanceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttendanceList $attendanceList)
    {
        $attendanceList->update([
            'present' => $request->present,
            'has_permission' => $request->permission,
            'sick' => $request->sick,
            'absent' => $request->absent,
        ]);

        return to_route('keuangan.absensi.index')
            ->with(['status' => 'Data Absensi Berhasil Diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendanceList  $attendanceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendanceList $attendanceList)
    {
        //
    }
}
