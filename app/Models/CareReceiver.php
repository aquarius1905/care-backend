<?php

namespace App\Models;

use App\Contracts\Auth\MustVerifyCareReceiverEmail;
use App\Foundation\Auth\CareReceiver as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CareReceiver extends Authenticatable implements MustVerifyCareReceiverEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $dates = ['birthday'];

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

    public function care_level()
    {
        return $this->belongsTo(CareLevel::class);
    }

    public function care_manager()
    {
        return $this->belongsTo(CareManager::class);
    }

    public function visit_datetime()
    {
        return $this->hasOne(VisitDatetime::class);
    }

    public function getCareManagerName()
    {
        return optional($this->care_manager)->name;
    }

    public function getVisitDate()
    {
        return optional($this->visit_datetime)->date;
    }

    public function getVisitTime()
    {
        return optional($this->visit_datetime)->time;
    }
}
