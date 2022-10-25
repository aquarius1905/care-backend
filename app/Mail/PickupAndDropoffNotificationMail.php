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
    protected $pickup_flg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        CareReceiver $care_receiver,
        $from_email,
        $pickup_flg
    ) {
        $this->care_receiver = $care_receiver;
        $this->from_email = $from_email;
        $this->pickup_flg = $pickup_flg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->pickup_flg ? 'お迎えのご連絡' : 'ご到着予定のご連絡';
        return $this->from($this->from_email)
            ->subject($subject)
            ->view('emails.pickup_and_dropoff_notification')
            ->with([
                'care_receiver' => $this->care_receiver,
                'pickup_flg' => $this->pickup_flg
            ]);
    }
}
