<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\Notification;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

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
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function cancelPayment($spaceId, $transactionId)
    {
        try {
            $space = Cowork::find($spaceId);
            if (!$space) {
                return redirect()->back()->with('error', 'No space found!');
            }

            $transaction = Transaction::find($transactionId);
            if (!$transaction) {
                return redirect()->back()->with('error', 'No transaction found!');
            }

            $transaction->delete();

            return redirect()->route('client_side.details', ['id' => $spaceId])->with('success', 'Payment cancelled!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function client_payment_success_page(Request $request)
    {
        try {
            $spaceId = $request->input('id');
            $transactionId = $request->input('transactionId');

            $space = Cowork::find($spaceId);
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
            return view('client_side.payment.payment_success_client', ['space' => $space, 'transaction' => $transaction])->with('success', 'Reservation done! Enjoy your cowork.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function paymentSuccess($id, $transactionId, $paymentMethod, $amount)
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

            //update payment amount and method
            $emailData = [
                'amount' => $amount,
                'payment_method' => $paymentMethod,
            ];

            $transaction->update($emailData);

            //create notifications
            $notification = Notification::create([
                "space_id" => $space->id,
                "user_id" => auth()->user()->id,
                "transaction_id" => $transaction->id,
                "subject" => "Reservation Pending",
                "content" => "Your reservation is pending.",
            ]);

            //send email
            $emailData = [
                "name" => auth()->user()->name,
                "subject" => "Cozone Reservation",
                "url" => url("/client_side/reservation/" . $transactionId)
            ];

            $mailController = new MailController();
            $mailController->sendMail($emailData, $space->email);

            if (!$notification) {
                return redirect()->back()->with('error', 'Notification creation error!');
            }

            return redirect()->route('client_side.payment.page.success', ['id' => $id, 'transactionId' => $transactionId])
                ->with('success', 'Reservation done! Enjoy your cowork.');
        } catch (Exception $emailDat) {
            return redirect()->back()->with('error', 'Error: ' . $emailDat->getMessage());
        }
    }



    public function paymentFailed(Request $request)
    {
        return redirect()->back()->with('error', 'GCash payment failed! Please try again or choose another payment method.');
    }

}