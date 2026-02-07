<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Debug: Check if user has notifications
        Log::info('User ID: ' . $user->id);
        Log::info('Total notifications: ' . $user->notifications()->count());
        Log::info('Unread notifications: ' . $user->unreadNotifications()->count());
        
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();
            
        $unreadCount = $user->unreadNotifications()->count();

        return view('employee.employeedash', compact('notifications', 'unreadCount'));
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->find($notificationId);

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.'
            ], 404);
        }

        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read.'
        ]);
    }

    /**
     * Mark all notifications as read for the authenticated user.
     */
    public function markAllAsRead(Request $request)
    {
        $user = Auth::user();
        $user->unreadNotifications()->update(['read_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read.'
        ]);
    }

    /**
     * Delete a specific notification.
     */
    public function destroy(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->find($notificationId);

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.'
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notification deleted successfully.'
        ]);
    }

    /**
     * Get unread notifications count for AJAX requests.
     */
    public function getUnreadCount()
    {
        $user = Auth::user();
        $count = $user->unreadNotifications()->count();

        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * Get recent notifications for dropdown/popup.
     */
    public function getRecent(Request $request)
    {
        $user = Auth::user();
        $limit = $request->get('limit', 5);

        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'data' => $notification->data,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at,
                    'time_ago' => $notification->created_at->diffForHumans(),
                    'is_read' => !is_null($notification->read_at),
                ];
            });

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $user->unreadNotifications()->count()
        ]);
    }

    /**
     * Clear all notifications for the authenticated user.
     */
    public function clearAll(Request $request)
    {
        $user = Auth::user();
        $user->notifications()->delete();

        return response()->json([
            'success' => true,
            'message' => 'All notifications cleared successfully.'
        ]);
    }

    /**
     * Mark notification as read and redirect to the URL specified in notification data.
     */
    public function readAndRedirect(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->find($notificationId);

        if (!$notification) {
            return redirect()->back()->with('error', 'Notification not found.');
        }

        // Mark as read
        $notification->markAsRead();

        // Redirect to URL if specified in notification data
        $url = $notification->data['url'] ?? '/dashboard';

        return redirect($url);
    }

    /**
     * Toggle notification read status.
     */
    public function toggleRead(Request $request, $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->find($notificationId);

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.'
            ], 404);
        }

        if ($notification->read_at) {
            // Mark as unread
            $notification->update(['read_at' => null]);
            $message = 'Notification marked as unread.';
        } else {
            // Mark as read
            $notification->markAsRead();
            $message = 'Notification marked as read.';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'is_read' => !is_null($notification->fresh()->read_at)
        ]);
    }
}