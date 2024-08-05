<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailDate;
    public function __construct($mailDate)
    {
        $this->mailDate = $mailDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Appointment Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.appointment'
        );
    }
    public function build()
    {
        return $this->view('email.appointment')
                    ->with([
                        'mailDate' => $this->mailDate,
                    ]);
    }
 
    public function attachments(): array
    {
        return [];
    }

 
 
}
