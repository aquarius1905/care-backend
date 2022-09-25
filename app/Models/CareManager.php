<?php

namespace App\Models;

use App\Contracts\Auth\MustVerifyCareManagerEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Foundation\Auth\CareManager as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CareManager extends Authenticatable implements MustVerifyCareManagerEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function care_receivers()
    {
        return $this->hasMany(CareReceiver::class);
    }
}
