<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Contracts\Auth\MustVerifyNursingCareOfficeEmail;
use App\Foundation\Auth\NursingCareOffice as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NursingCareOffice extends Authenticatable implements MustVerifyNursingCareOfficeEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = array('id');

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

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
    }
}
