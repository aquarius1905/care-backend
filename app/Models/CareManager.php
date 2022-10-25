<?php

namespace App\Models;

use App\Contracts\Auth\MustVerifyCareManagerEmail;
use App\Foundation\Auth\CareManager as Authenticatable;
use App\Notifications\Api\Auth\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'email_verified_at',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
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
