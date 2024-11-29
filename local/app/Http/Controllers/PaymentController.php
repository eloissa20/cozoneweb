<?php

namespace App\Http\Controllers;

use App\Models\Cowork;
use App\Models\Transaction;


class PaymentController extends Controller
{
    public function client_payment_success($id, $transactionId)
    {
        $space = Cowork::find($id);
        if (!$space) {
            return abort(404, 'Space not found');
        }

        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            return abort(404, 'Transaction not found');
        }

        return view('client_side.payment.payment_success_client', ['space' => $space, 'transaction' => $transaction]);
    }

    public function client_payment($id, $transactionId)
    {
        $space = Cowork::find($id);
        if (!$space) {
            return abort(404, 'Space not found');
        }

        $transaction = Transaction::find($transactionId);
        if (!$transaction) {
            return abort(404, 'Transaction not found');
        }

        return view('client_side.payment.payment_client', ['space' => $space, 'transaction' => $transaction]);
    }
}
