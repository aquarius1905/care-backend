<?php

namespace App\Auth\Events;

use Illuminate\Queue\SerializesModels;

class CareManagerRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $care_manager;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $care_manager
     * @return void
     */
    public function __construct($care_manager)
    {
        $this->care_manager = $care_manager;
    }
}
