<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Holiday;


class DashboardController extends Controller
{
    public function employeeDashboard()
    {
        $user = Auth::user();
        $today = Carbon::today();
        
        // Get today's attendance
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        // Calculate today's worked hours
        $todayHours = 0;
        if ($attendance && $attendance->check_in) {
            if ($attendance->check_out) {
                $todayHours = round(
                    Carbon::parse($attendance->check_in)
                        ->diffInMinutes(Carbon::parse($attendance->check_out)) / 60, 
                    2
                );
            } else {
                // If still checked in, calculate hours until now
                $todayHours = round(
                    Carbon::parse($attendance->check_in)
                        ->diffInMinutes(now()) / 60, 
                    2
                );
            }
        }

        // Calculate monthly worked hours
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        $monthAttendances = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->get();

        $monthHours = round($monthAttendances->sum(function ($a) {
            if ($a->check_in && $a->check_out) {
                return Carbon::parse($a->check_out)
                    ->diffInMinutes(Carbon::parse($a->check_in));
            } elseif ($a->check_in) {
                return Carbon::now()
                    ->diffInMinutes(Carbon::parse($a->check_in));
            }
            return 0;
        }) / 60, 2);

        // Get leave statistics
        $employee = $user->employee;
        $leaves = collect();
        
        if ($employee) {
            $leaves = $employee->leaves;
        }

        // Get recent activities
        $recentActivities = $this->getRecentActivities($user, $employee);

    
        $weeklyAttendance = [];
$days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];

foreach ($days as $i => $day) {
    $date = Carbon::now()->startOfWeek()->addDays($i);
    $attendance = Attendance::where('user_id', $user->id)
        ->whereDate('date', $date)
        ->first();

    $hours = 0;
    if ($attendance && $attendance->check_in) {
        $checkOut = $attendance->check_out ?: now();
        $hours = round(Carbon::parse($attendance->check_in)->diffInMinutes(Carbon::parse($checkOut)) / 60, 2);
    }

    $weeklyAttendance[] = [
        'day' => $date->format('D'),
        'hours' => $hours
    ];
}

$dailyHours = [];
$monthDays = Carbon::now()->daysInMonth;

for ($i = 1; $i <= $monthDays; $i++) {
    $date = Carbon::now()->startOfMonth()->addDays($i - 1);
    $attendance = Attendance::where('user_id', $user->id)
        ->whereDate('date', $date)
        ->first();

    $hours = 0;
    if ($attendance && $attendance->check_in) {
        $checkOut = $attendance->check_out ?: now();
        $hours = round(Carbon::parse($attendance->check_in)->diffInMinutes(Carbon::parse($checkOut)) / 60, 2);
    }

    $dailyHours[] = [
        'day' => $date->format('d'),
        'hours' => $hours
    ];
}

$holidays = Holiday::orderBy('date', 'asc')->get();

$notifications = $user->notifications->take(10);

 return view('employee.employeedash', [
            'todayHours' => $todayHours,
            'monthHours' => $monthHours,
            'attendance' => $attendance,
            'total' => $leaves->count(),
            'approved' => $leaves->where('status', 'approved')->count(),
            'pending' => $leaves->where('status', 'pending')->count(),
            'declined' => $leaves->where('status', 'rejected')->count(),
            'recentActivities' => $recentActivities,
            'weeklyAttendance' => $weeklyAttendance,
            'dailyHours' => $dailyHours,
             'leaveStats' => [
    'Approved' => $leaves->where('status', 'approved')->count(),
    'Pending' => $leaves->where('status', 'pending')->count(),
    'Rejected' => $leaves->where('status', 'rejected')->count(),
],
      'notifications' => $notifications,  
      'holidays' => $holidays,
        ]);

    }

    private function getRecentActivities($user, $employee)
    {
        $activities = collect();

        // Get recent attendance activities (last 7 days)
        $recentAttendances = Attendance::where('user_id', $user->id)
            ->where('date', '>=', Carbon::now()->subDays(7))
            ->orderBy('date', 'desc')
            ->get();

        foreach ($recentAttendances as $attendance) {
            if ($attendance->check_in) {
                $activities->push([
                    'type' => 'check_in',
                    'title' => 'Checked in for ' . Carbon::parse($attendance->date)->format('M d'),
                    'time' => Carbon::parse($attendance->check_in),
                    'icon' => 'ri-login-box-line',
                    'icon_class' => 'success',
                    'status' => 'Completed',
                    'status_class' => 'success'
                ]);
            }

            if ($attendance->check_out) {
                $activities->push([
                    'type' => 'check_out',
                    'title' => 'Checked out for ' . Carbon::parse($attendance->date)->format('M d'),
                    'time' => Carbon::parse($attendance->check_out),
                    'icon' => 'ri-logout-box-line',
                    'icon_class' => 'info',
                    'status' => 'Completed',
                    'status_class' => 'success'
                ]);
            }
        }

        // Get recent leave activities (last 30 days)
        if ($employee) {
            $recentLeaves = $employee->leaves()
                ->where('created_at', '>=', Carbon::now()->subDays(30))
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            foreach ($recentLeaves as $leave) {
                $statusClass = match ($leave->status) {
                    'approved' => 'success',
                    'pending' => 'warning',
                    'rejected' => 'danger',
                    default => 'info'
                };

                $activities->push([
                    'type' => 'leave',
                    'title' => ucfirst($leave->leave_type) . ' leave request',
                    'time' => $leave->created_at,
                    'icon' => 'ri-calendar-line',
                    'icon_class' => $statusClass,
                    'status' => ucfirst($leave->status),
                    'status_class' => $statusClass
                ]);
            }
        }

        return $activities->sortByDesc('time')->take(5)->values();
    }

   

}
