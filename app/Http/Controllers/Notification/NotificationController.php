<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Models\NotificationRecipient;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function toggle($id)
    {
        $recipient = NotificationRecipient::where('id', $id)
            ->where('recipient_id', auth('customer')->id()) // ensure it belongs to the logged-in user
            ->where('recipient_type', get_class(auth('customer')->user()))
            ->firstOrFail();

        // Toggle read/unread
        if ($recipient->read_at) {
            $recipient->read_at = null;
        } else {
            $recipient->read_at = Carbon::now();
        }

        $recipient->save();

        return back()->with('success', 'Notification status updated.');
    }

}
