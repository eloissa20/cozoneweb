<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\Review;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function processReservation(Request $request, $spaceId)
    {
        try {
            // Get the current user's ID
            $userId = auth()->id();
            $reservationDate = $request->input('reservation_date');
            $arrivalTime = $request->input('arrival');

            // 1. Check if the user has a pending reservation for this coworking space
            $pendingReservation = Transaction::where('user_id', $userId)
                ->where('reservation_date', $reservationDate)
                ->where('space_id', $spaceId)
                ->where('status', 'PENDING')
                ->exists();

            if ($pendingReservation) {
                return redirect()->route('client_side.details', ['id' => $spaceId])->with('error', 'You already have a pending reservation at this space with the same date.');
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
            $reservation->amount = $request->input('price');
            $reservation->status = 'PENDING';
            $reservation->save();

            return redirect()->route('client_side.payment', ['id' => $spaceId, 'transactionId' => $reservation->id])
                ->with('success', 'Reservation successfully made! Proceed to payment.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }

    }

    public function paymentProcess(Request $request, $spaceId, $transactionId)
    {
        try {
            if ($request->input('payment_method') === 'gcash') {
                dd('gcash payment');
            } else {
                $transaction = Transaction::find($transactionId);

                if (!$transaction) {
                    return redirect()->back()->with('error', 'No transaction found!');
                }

                $data = [
                    'amount' => $request->input('total_amount'),
                    'payment_method' => $request->input('payment_method'),
                ];

                $transaction->update($data);
            }

            return redirect()->route('client_side.payment.success', ['id' => $spaceId, 'transactionId' => $transactionId])
                ->with('success', 'Reservation done! Enjoy your cowork.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }

    }


    public function viewReservation($reservationId)
    {
        try {
            $transaction = Transaction::find($reservationId);
            if (!$transaction) {
                return redirect()->back()->with('error', 'No transaction found!');
            }

            $space = Cowork::find($transaction->space_id);
            if (!$space) {
                return redirect()->back()->with('error', 'No space found!');
            }


            if ($transaction->user_id !== auth()->user()->id) {
                return redirect()->back();
            }

            return view('client_side.reservation.reservation_details', ['space' => $space, 'transaction' => $transaction]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

}