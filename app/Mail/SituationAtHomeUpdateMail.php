<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DaycareDiary;

class SituationAtHomeUpdateEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $daycare_diary;
    protected $from_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        DaycareDiary $daycare_diary,
        $from_email
    ) {
        $this->daycare_diary = $daycare_diary;
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
            ->subject("ご家庭のでの状況が更新されました")
            ->view('emails.situation_at_home_update')
            ->with([
                'diary' => $this->daycare_diary
            ]);
    }
}
