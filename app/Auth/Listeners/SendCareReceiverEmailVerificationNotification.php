<?php

namespace App\Auth\Listeners;

use App\Auth\Events\CareReceiverRegistered;
use App\Contracts\Auth\MustVerifyCareReceiverEmail;

class SendCareReceiverEmailVerificationNotification
{
  /**
   * Handle the event.
   *
   * @param  \Illuminate\Auth\Events\Registered  $event
   * @return void
   */
  public function handle(CareReceiverRegistered $event)
  {
    if (
      $event->care_receiver instanceof MustVerifyCareReceiverEmail &&
      !$event->care_receiver->hasVerifiedEmail()
    ) {
      $event->care_receiver->sendEmailVerificationNotification();
    }
  }
}
