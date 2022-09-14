<?php

namespace App\Auth\Events;

use Illuminate\Queue\SerializesModels;

class NursingCareOfficeRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $nursing_care_office;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($nursing_care_office)
    {
        $this->nursing_care_office = $nursing_care_office;
    }
}
