<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailService extends Mailable
{
    use Queueable, SerializesModels;

    /**
     *  @var \App\Models\Subscriber
     */
    protected Subscriber $subscriber;

    /**
     *
     */
    protected mixed $headline;
    protected mixed $daily;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscriber, $headline, $daily)
    {
        //
        $this->subscriber = $subscriber;
        $this->headline = $headline;
        $this->daily = $daily;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: "Today's weather",
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
            view: 'emails.mail',
            with: [
                'subscriber' => $this->subscriber,
                'headline' => $this->headline,
                'daily' => $this->daily,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
