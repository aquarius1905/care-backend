<?php

namespace App\Auth\Events;

use Illuminate\Queue\SerializesModels;

class CareReceiverRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $care_receiver;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $care_manager
     * @return void
     */
    public function __construct($care_receiver)
    {
        $this->care_receiver = $care_receiver;
    }
}
