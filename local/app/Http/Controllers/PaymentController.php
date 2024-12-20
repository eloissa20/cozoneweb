<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\Notification;
use App\Models\Transaction;
use Exception;

class PaymentController extends Controller
{
    public function client_payment_success($id, $transactionId)
    {
        try {
            $space = Cowork::find($id);
            if (!$space) {
                return redirect()->back()->with('error', 'No space found!');
            }

            $transaction = Transaction::find($transactionId);
            if (!$transaction) {
                return redirect()->back()->with('error', 'No transaction found!');
            }

            if ($transaction->user_id !== auth()->user()->id) {
                return redirect()->back();
            }
            
            //create notifications
            $notification = Notification::create([
                "space_id" => $space->id,
                "user_id" => auth()->user()->id,
                "transaction_id" => $transaction->id,
                "subject" => "Reservation Pending",
                "content" => "Your reservation is pending.",
            ]);

            if (!$notification) {
                return redirect()->back()->with('error', 'Notification creation error!');
            }

            //send email
            $data = [
                "name" => auth()->user()->name,
                "subject" => "Cozone Reservation",
                "url" => url("/client_side/reservation/" . $transactionId)
            ];

            $mailController = new MailController();
            $mailController->sendMail($data, $space->email);

            return view('client_side.payment.payment_success_client', ['space' => $space, 'transaction' => $transaction]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    public function client_payment($id, $transactionId)
    {
        try {
            $space = Cowork::find($id);
            if (!$space) {
                return redirect()->back()->with('error', 'No space found!');
            }

            $transaction = Transaction::find($transactionId);
            if (!$transaction) {
                return redirect()->back()->with('error', 'No transaction found!');
            }

            if ($transaction->user_id !== auth()->user()->id) {
                return redirect()->back();
            }

            if ($transaction->payment_method !== null) {
                return redirect()->back()->with('error', 'This reservation is already done with payment.');
            }

            return view('client_side.payment.payment_client', ['space' => $space, 'transaction' => $transaction]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e);
        }

    }
}