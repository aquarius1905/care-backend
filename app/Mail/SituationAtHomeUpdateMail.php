<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DaycareDiary;
use Log;

class SituationAtHomeUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $diary;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DaycareDiary $diary)
    {
        $this->diary = $diary;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject("ご家庭のでの状況が更新されました")
            ->markdown('emails.situation_at_home_update')
            ->with([
                'nursing_care_office_name' => $this->diary->getNursingCareOfficeName(),
                'diary_date' => $this->diary->getFormattedDate(),
                'care_receiver_name' => $this->diary->getCareReceiverName(),
                'situation_at_Home' => $this->diary->situation_at_home
            ]);
    }
}
