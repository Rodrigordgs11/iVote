<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Uuid;

class NotificationController extends Controller
{

    public function create(Request $request)
    {
        $poll_uuid = Route::input('poll')->uuid;
        $user_uuids = $request->users; 

        foreach ($user_uuids as $user_uuid) {
            $notification = new Notification();
            $notification->uuid = Uuid::uuid4()->toString();
            $notification->user_uuid = $user_uuid;
            $notification->poll_uuid = $poll_uuid;
            $notification->save();
        }
        return redirect()->back();
    }

    public function seen(Notification $notification)
    {
        $notification->update(['seen' => true]);

        return redirect()->route('polls.getId', ['poll' => $notification->poll]);
    }
}
