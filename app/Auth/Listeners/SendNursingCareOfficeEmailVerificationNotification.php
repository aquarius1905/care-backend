<?php

namespace App\Auth\Listeners;

use App\Auth\Events\NursingCareOfficeRegistered;
use App\Contracts\Auth\MustVerifyNursingCareOfficeEmail;

class SendNursingCareOfficeEmailVerificationNotification
{
  /**
   * Handle the event.
   *
   * @param  \Illuminate\Auth\Events\Registered  $event
   * @return void
   */
  public function handle(NursingCareOfficeRegistered $event)
  {
    if (
      $event->nursing_care_office instanceof MustVerifyNursingCareOfficeEmail && !$event->nursing_care_office->hasVerifiedEmail()
    ) {
      $event->nursing_care_office->sendEmailVerificationNotification();
    }
  }
}
