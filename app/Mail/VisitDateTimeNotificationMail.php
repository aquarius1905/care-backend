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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CareReceiver $care_receiver)
    {
        $this->care_receiver = $care_receiver;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject("次回訪問日時のご連絡")
            ->markdown('emails.visit_datetime')
            ->with([
                'care_receiver' => $this->care_receiver
            ]);
    }
}
