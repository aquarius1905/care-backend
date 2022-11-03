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
                'nursingCareOfficeName' => $this->diary->getNursingCareOfficeName(),
                'diaryDate' => $this->diary->getFormattedDate(),
                'careReceiverName' => $this->diary->getCareReceiverName(),
                'situationAtHome' => $this->diary->situation_at_home
            ]);
    }
}
