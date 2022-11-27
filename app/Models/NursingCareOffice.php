<?php

namespace App\Models;

use App\Auth\Notifications\ResetNursingCareOfficePassword;
use App\Contracts\Auth\MustVerifyNursingCareOfficeEmail;
use App\Foundation\Auth\NursingCareOffice as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    protected $with = ['service_type'];

    public function service_type()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function daycare_diaries()
    {
        return $this->belongsTo(DaycareDiary::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetNursingCareOfficePassword($token));
    }
}
