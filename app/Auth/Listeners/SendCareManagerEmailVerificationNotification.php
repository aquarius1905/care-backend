<?php

namespace App\Auth\Listeners;

use App\Auth\Events\CareManagerRegistered;
use App\Contracts\Auth\MustVerifyCareManagerEmail;

class SendCareManagerEmailVerificationNotification
{
  /**
   * Handle the event.
   *
   * @param  \Illuminate\Auth\Events\Registered  $event
   * @return void
   */
  public function handle(CareManagerRegistered $event)
  {
    if (
      $event->care_manager instanceof MustVerifyCareManagerEmail &&
      !$event->care_manager->hasVerifiedEmail()
    ) {
      $event->care_manager->sendEmailVerificationNotification();
    }
  }
}
