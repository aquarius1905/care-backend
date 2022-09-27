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
