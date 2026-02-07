<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use App\Models\Employee;
use App\Models\leave;
use Carbon\Carbon;
use App\Models\Attendance;

class DashboardController extends Controller
{
 


public function dashboard()
{
    $holidays = Holiday::all();
    $employeeList = Employee::all();
    $leaves = Leave::with('employee')->latest()->get();

    $today = Carbon::today()->toDateString();
    $checkedInUserIds = Attendance::whereDate('date', $today)->pluck('user_id');
$absentEmployees = Employee::whereNotIn('user_id', $checkedInUserIds)->take(5)->get();

    $attendanceStats = [
        'present' => $checkedInUserIds->count(),
        'absent' => $absentEmployees->count(),
    ];

    $leaveStats = [
        'pending' => $leaves->where('status', 'pending')->count(),
        'approved' => $leaves->where('status', 'approved')->count(),
        'rejected' => $leaves->where('status', 'rejected')->count(),
    ];

    return view('admin.dashboard', compact('holidays', 'employeeList', 'leaves', 'absentEmployees', 'attendanceStats', 'leaveStats'));
}

}
