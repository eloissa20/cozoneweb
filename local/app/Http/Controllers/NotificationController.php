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
        $notifications = auth()->user()->user_notifications;

        // Ensure $notifications contains the data
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