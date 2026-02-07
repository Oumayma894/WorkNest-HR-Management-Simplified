<?php
// 1. FIXED LeaveStatusUpdated Notification
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Leave;

class LeaveStatusUpdated extends Notification
{
    use Queueable;

    public $leave;

    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Leave Status Updated',
            'message' => "Your {$this->leave->leave_type} leave has been {$this->leave->status}.",
            'leave_id' => $this->leave->id,
            'url' => "/employee/leaves/{$this->leave->id}",
            'icon' => 'ri-file-list-line',
            'color' => $this->leave->status === 'approved' ? 'success' : 'danger',
        ];
    }
}
