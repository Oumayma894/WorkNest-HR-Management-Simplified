<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->first();

        // Calculate worked hours for today's attendance
        $workedHours = '0.00';
        if ($attendance && $attendance->check_in) {
            if ($attendance->check_out) {
                $workedHours = round(Carbon::parse($attendance->check_in)->diffInMinutes(Carbon::parse($attendance->check_out)) / 60, 2);
            } else {
                $workedHours = round(Carbon::parse($attendance->check_in)->diffInMinutes(now()) / 60, 2);
            }
        }

        // Calculate today's worked hours
        $todayHours = 0;
        if ($attendance && $attendance->check_in) {
            if ($attendance->check_out) {
                $todayHours = round(Carbon::parse($attendance->check_in)->diffInMinutes(Carbon::parse($attendance->check_out)) / 60, 2);
            } else {
                $todayHours = round(Carbon::parse($attendance->check_in)->diffInMinutes(now()) / 60, 2);
            }
        }

        // Weekly stats
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $weekAttendances = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$weekStart, $weekEnd])
            ->get();

        $weekHours = $weekAttendances->sum(function ($a) {
            if ($a->check_in && $a->check_out) {
                return Carbon::parse($a->check_out)->diffInMinutes(Carbon::parse($a->check_in));
            } elseif ($a->check_in) {
                return Carbon::now()->diffInMinutes(Carbon::parse($a->check_in));
            }
            return 0;
        }) / 60;

        // Monthly stats
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        $monthAttendances = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->get();

        $monthHours = $monthAttendances->sum(function ($a) {
            if ($a->check_in && $a->check_out) {
                return Carbon::parse($a->check_out)->diffInMinutes(Carbon::parse($a->check_in));
            } elseif ($a->check_in) {
                return Carbon::now()->diffInMinutes(Carbon::parse($a->check_in));
            }
            return 0;
        }) / 60;

        // Total overtime this month
        $overtime = $monthAttendances->sum('overtime_minutes') / 60;

        // Activity log
        $activities = [];
        if ($attendance) {
            if ($attendance->check_in) {
                $activities[] = ['type' => 'Check In', 'time' => $attendance->check_in];
            }
            if ($attendance->check_out) {
                $activities[] = ['type' => 'Check Out', 'time' => $attendance->check_out];
            }
        }

        // Attendance history (used in table)
        $attendances = Attendance::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        return view('employee.attendance', compact(
            'attendance',
            'workedHours',
            'todayHours',
            'weekHours',
            'monthHours',
            'overtime',
            'activities',
            'attendances'
        ));
    }

    public function checkIn()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            ['check_in' => now()]
        );

        return redirect()->back()->with('success', 'Checked in at ' . now()->format('h:i A'));
    }

    public function checkOut()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->first();

        if ($attendance && !$attendance->check_out) {
            $attendance->check_out = now();

            $workedMinutes = Carbon::parse($attendance->check_in)->diffInMinutes(now());

            // Simulated break/overtime logic (adjust as needed)
            $attendance->break_minutes = 60;
            $attendance->overtime_minutes = max(0, $workedMinutes - 8 * 60 - 60);

            $attendance->save();
        }

        return redirect()->back()->with('success', 'Checked out at ' . now()->format('h:i A'));
    }
}