<?php

namespace App\Mail;

use App\Models\VisitDatetime;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitDatetimeReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $visit_datetime;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VisitDatetime $visit_datetime)
    {
        $this->visit_datetime = $visit_datetime;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject('訪問前日のお知らせ')
            ->markdown('emails.visit_datetime_reminder')
            ->with([
                'keyperson_name' => $this->visit_datetime->getKeyPersonName(),
                'care_receiver_name' => $this->visit_datetime->getCareReceiverName(),
                'care_manager_name' => $this->visit_datetime->getCareManagerName(),
                'date' => $this->visit_datetime->getFormattedVisitDate(),
                'time' => $this->visit_datetime->time->format('H時i分'),
            ]);
    }
}
