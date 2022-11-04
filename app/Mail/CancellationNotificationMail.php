<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cancellation;

class CancellationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $cancellation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cancellation $cancellation)
    {
        $this->cancellation = $cancellation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject("キャンセル通知")
            ->markdown('emails.cancellation_notification')
            ->with([
                'care_receiver_name' => $this->cancellation->getCareReceiverName(),
                'nursing_care_office_name' => $this->cancellation->getNursingCareOfficeName(),
                'date_of_visit' => $this->cancellation->getFormattedDate(),
                'reason' => $this->cancellation->reason
            ]);
    }
}
