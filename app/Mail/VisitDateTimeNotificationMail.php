<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CareReceiver;

class VisitDateTimeNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $care_receiver;
    protected $from_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        CareReceiver $care_receiver,
        $from_email
    ) {
        $this->care_receiver = $care_receiver;
        $this->from_email = $from_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_email)
            ->subject("次回訪問日時のご連絡")
            ->view('emails.visit_datetime')
            ->with([
                'care_receiver' => $this->care_receiver
            ]);
    }
}
