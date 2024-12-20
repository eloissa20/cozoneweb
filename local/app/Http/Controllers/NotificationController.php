<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function show(Notification $notification)
    {
        //
    }

    public function showAll(Notification $notification)
    {
        // Fetch notifications and order them (e.g., by created_at in descending order)
        $notifications = auth()->user()->user_notifications()->orderBy('created_at', 'desc')->get();

        // Return the notifications as a JSON response
        return response()->json([
            'success' => true,
            'data' => $notifications,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
    }
}