<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Mailer extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    protected $layout;
    protected $pdfPath;
    protected $pdfName;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $layout, $subject, $pdfPath = null, $pdfName = null)
    {
        $this->data = $data;
        $this->layout = $layout;
        $this->subject = $subject;
        $this->pdfPath = $pdfPath;
        $this->pdfName = $pdfName;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->view($this->layout)
            ->subject($this->subject)
            ->with('data', $this->data);

        if ($this->pdfPath && $this->pdfName) {
            $email->attach($this->pdfPath, [
                'as' => $this->pdfName,
                'mime' => 'application/pdf',
            ]);
        }

        return $email;
    }
}