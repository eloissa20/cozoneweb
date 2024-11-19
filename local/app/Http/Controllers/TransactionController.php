<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function processReservation(Request $request, $spaceId)
    {

        $reservation = new Transactions();
        $reservation->user_id = auth()->id();
        $reservation->space_id = $spaceId;
        $reservation->reservation_date = $request->input('reservation_date');
        $reservation->hours = $request->input('hours');
        $reservation->guests = $request->input('guests');
        $reservation->name = $request->input('name');
        $reservation->email = $request->input('email');
        $reservation->company = $request->input('company');
        $reservation->contact = $request->input('contact');
        $reservation->arrival_time = $request->input('arrival');
        $reservation->save();

        return redirect()->route('client_side.payment', ['id' => $spaceId, 'transactionId' => $reservation->id])
            ->with('success', 'Reservation successfully made! Proceed to payment.');
    }

}