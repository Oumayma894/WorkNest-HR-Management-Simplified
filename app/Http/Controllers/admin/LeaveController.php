<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\LeaveStatusUpdated;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('employee')
            ->orderBy('created_at', 'desc')
            ->get();
                     
        $notifications = Auth::user()->unreadNotifications->sortByDesc('created_at');
          
        return view('admin.adminleave', [
            'leaves' => $leaves,
            'notifications' => $notifications
        ]);
    }

    public function updateStatus(Request $request, Leave $leave)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        if (strtolower($leave->status) !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Only pending leaves can be updated.'
            ], 403);
        }

        $leave->update([
            'status' => $request->status,
            'admin_id' => 1
        ]);

        // Enhanced debugging for notification creation
        Log::info('Attempting to send notification for leave: ' . $leave->id);
        
        if ($leave->employee && $leave->employee->user) {
            Log::info('Employee found: ' . $leave->employee->id . ', User: ' . $leave->employee->user->id);
            
            try {
                $leave->employee->user->notify(new LeaveStatusUpdated($leave));
                Log::info('Notification sent successfully');
                
                // Verify notification was created
                $notificationCount = $leave->employee->user->notifications()->count();
                Log::info('Total notifications for user: ' . $notificationCount);
                
            } catch (\Exception $e) {
                Log::error('Failed to send notification: ' . $e->getMessage());
            }
        } else {
            Log::warning('Employee or user not found for leave: ' . $leave->id);
        }

        return response()->json([
            'success' => true,
            'message' => 'Leave status updated successfully.'
        ]);
    }
}