<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareReceiver extends Model
{
    use HasFactory;

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

    public function key_person()
    {
        return $this->belongsTo(KeyPerson::class);
    }

    public function visit_datetime()
    {
        return $this->hasOne(VisitDatetime::class);
    }

    public function getKeyPersonEmail()
    {
        return optional($this->key_person)->email;
    }

    public function getKeyPersonName()
    {
        return optional($this->key_person)->name;
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
