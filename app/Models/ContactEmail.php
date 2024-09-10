<?php

namespace App\Models;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function envelope()
    {
        return new Envelope(
            subject: $this->data['subject'],
            from: $this->data['email'],
        );
    }


    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.contact',
            with: $this->data
        );
    }
}
