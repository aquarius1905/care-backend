<?php

namespace App\Auth\Events;

use Illuminate\Queue\SerializesModels;

class ManagerRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $manager;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }
}
