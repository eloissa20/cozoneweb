<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function processReservation(Request $request, $spaceId)
    {

        // Get the current user's ID
        $userId = auth()->id();
        $reservationDate = $request->input('reservation_date');
        $arrivalTime = $request->input('arrival');

        // 1. Check if the user has a pending reservation for this coworking space
        $pendingReservation = Transaction::where('user_id', $userId)
            ->where('space_id', $spaceId)
            ->where('status', 'PENDING')
            ->exists();

        if ($pendingReservation) {
            return redirect()->route('client_side.details', ['id' => $spaceId])->with('error', 'You already have a pending reservation at this space.');
        }

        // 2. Check if another user has a confirmed reservation on the same date and time
        $conflictingReservation = Transaction::where('space_id', $spaceId)
            ->where('reservation_date', $reservationDate)
            ->where('arrival_time', $arrivalTime)
            ->where('status', 'CONFIRMED')
            ->exists();

        if ($conflictingReservation) {
            return redirect()->route('client_side.details', ['id' => $spaceId])->with('error', 'The space is already reserved by another user at the chosen date and time.');
        }

        $reservation = new Transaction();
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
        $reservation->status = 'PENDING';
        $reservation->save();

        return redirect()->route('client_side.payment', ['id' => $spaceId, 'transactionId' => $reservation->id])
            ->with('success', 'Reservation successfully made! Proceed to payment.');
    }

    public function paymentProcess(Request $request, $spaceId, $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        $data = [
            'amount' => $request->input('total_amount'),
            'payment_method' => 'COD'
        ];

        $transaction->update($data);

        return redirect()->route('client_side.payment.success', ['id' => $spaceId, 'transactionId' => $transactionId])
            ->with('success', 'Reservation done! Enjoy your cowork.');
    }

}
