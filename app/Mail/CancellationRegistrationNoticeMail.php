<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Cancellation;

class CancellationRegistrationNoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $cancellation;
    protected $from_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        Cancellation $cancellation,
        $from_email
    ) {
        $this->cancellation = $cancellation;
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
            ->subject("キャンセル登録が完了しました")
            ->view('emails.cancellation_registration_notice')
            ->with([
                'cancellation' => $this->cancellation
            ]);
    }
}
