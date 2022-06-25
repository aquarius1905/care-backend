<?php

namespace App\Auth\Events;

use Illuminate\Queue\SerializesModels;

class ProviderRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $provider;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($provider)
    {
        $this->provider = $provider;
    }
}
