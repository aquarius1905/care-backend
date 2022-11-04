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
                'keyperson_name' => $this->care_receiver->keyperson_name,
                'care_receiver_name' => $this->care_receiver->name,
                'care_manager_name' => $this->care_receiver->getCareManagerName(),
                'date_of_visit' => $this->care_receiver->getFormattedVisitDate(),
                'time' => $this->care_receiver->getVisitTime()->format('H時i分')
            ]);
    }
}
