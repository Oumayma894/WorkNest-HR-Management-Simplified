<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LeaveController extends Controller
{
    public function index()
    {
        $user = Auth::user(); 
        $employee = $user->employee;

        if (!$employee) {
            return back()->with('error', 'Employee record not found.');
        }

        $leaves = $employee->leaves()->latest()->get();
        $notifications = $user->unreadNotifications->sortByDesc('created_at'); 

        return view('employee.leave', [
    'leaves' => $leaves,
    'notifications' => $notifications,
    'total' => $leaves->count(),
    'approved' => $leaves->where('status', 'approved')->count(),
    'pending' => $leaves->where('status', 'pending')->count(),
    'declined' => $leaves->where('status', 'rejected')->count(), 
]);

    }

  public function store(Request $request)
{
    $request->validate([
        'leave_type' => 'required|string',
        'date_from' => 'required|date',
        'date_to' => 'required|date|after_or_equal:date_from',
        'number_of_day' => 'required|integer|min:1',
        'reason' => 'required|string',
        'leave_day' => 'nullable|string'
    ]);

    $user = Auth::user();
    $employee = $user->employee;

    if (!$employee) {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Employee record not found.'], 404);
        }
        return back()->with('error', 'Employee record not found.');
    }

    // 🛑 Check if there’s a holiday within the date range
    $holidays = Holiday::whereBetween('date', [$request->date_from, $request->date_to])->get();

    if ($holidays->isNotEmpty()) {
        $dates = $holidays->pluck('date')->join(', ');
        $message = "You cannot request leave on the following holiday date(s): $dates";

        if ($request->expectsJson()) {
            return response()->json(['error' => $message], 422);
        }
        return back()->with('error', $message);
    }

    // 🛑 Check if similar leave already exists
    $existing = Leave::where('employee_id', $employee->id)
        ->where('date_from', $request->date_from)
        ->where('date_to', $request->date_to)
        ->where('reason', $request->reason)
        ->first();

    if ($existing) {
        return back()->with('error', 'You have already submitted a similar leave request.');
    }

    // ✅ All checks passed, create leave
    Leave::create([
        'employee_id' => $employee->id,
        'leave_type' => $request->leave_type,
        'date_from' => $request->date_from,
        'date_to' => $request->date_to,
        'number_of_day' => $request->number_of_day,
        'reason' => $request->reason,
        'leave_day' => $request->leave_day,
        'status' => 'pending',
    ]);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => 'Leave request submitted successfully.',
            'remainingLeaves' => 10 // Placeholder logic
        ]);
    }

    return back()->with('success', 'Leave request submitted successfully.');
}



    public function updateStatus(Request $request, Leave $leave)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $leave->update([
    'status' => $request->status,
    'admin_id' => 1 
]);

        return back()->with('success', "Leave has been {$request->status}.");
    }

    public function update(Request $request, Leave $leave)
{
    // Only allow updates for pending leaves
    if (strtolower($leave->status) !== 'pending') {
        return response()->json([
            'success' => false,
            'message' => 'Only pending leaves can be updated.'
        ], 403);
    }

    $validated = $request->validate([
        'leave_type' => 'required|string',
        'date_from' => 'required|date',
        'date_to' => 'required|date|after_or_equal:date_from',
        'number_of_day' => 'required|integer|min:1',
        'reason' => 'required|string',
        'leave_day' => 'nullable|string'
    ]);

    $leave->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Leave request updated successfully.'
    ]);
}



public function destroy(Leave $leave)
{
    if (strtolower($leave->status) !== 'pending') {
        return response()->json([
            'success' => false,
            'message' => 'Only pending leaves can be deleted.'
        ], 403);
    }

    $leave->delete();

    return response()->json([
        'success' => true,
        'message' => 'Leave request deleted successfully.'
    ]);
}

}
