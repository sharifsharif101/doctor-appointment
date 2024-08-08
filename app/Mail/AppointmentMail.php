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

    /**
     * Create a new message instance.
     */
    public $subject;
    public $body;
    public $mailData;
     public function __construct($subject,$body,$mailData)
    {
       $this->subject=$subject;
       $this->body=$body;
       $this->mailData = $mailData;

 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'mail',
    //     );
    // }

    public function content(): Content
    {
        return new Content(
            view: 'mail',
            with: array_merge([
                'subject' => $this->subject,
                'body' => $this->body,
            ], $this->mailData),
        );
    }

 
    public function attachments(): array
    {
        return [];
    }
}
