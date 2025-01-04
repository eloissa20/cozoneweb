<?php

namespace App\Http\Controllers;

use App\Mail\Mailer;
use Mail;

class MailController extends Controller
{
    public function sendMail($data, $email)
    {
        $layout = 'mail_layouts.reservation_pending';
        $subject = $data['subject'];

        try {
            Mail::to($email)->send(new Mailer($data, $layout, $subject));

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendMailToCozone($data)
    {
        $layout = 'mail_layouts.email_to_cozone';
        $subject = $data['subject'];

        try {
            Mail::to('cozoneest24@gmail.com')->send(new Mailer($data, $layout, $subject));

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
