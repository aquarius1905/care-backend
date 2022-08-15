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
    protected $from_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(VisitDatetime $visit_datetime, $from_email)
    {
        $this->visit_datetime = $visit_datetime;
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
            ->subject('訪問前日のお知らせ')
            ->view('emails.visit_datetime_reminder')
            ->with(['visit_datetime' => $this->visit_datetime]);
    }
}
