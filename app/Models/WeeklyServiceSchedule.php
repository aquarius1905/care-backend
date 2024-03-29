<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyServiceSchedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['date', 'time'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $with = ['nursing_care_office', 'cancellations'];

    public function care_receiver()
    {
        return $this->belongsTo(CareReceiver::class);
    }

    public function nursing_care_office()
    {
        return $this->belongsTo(NursingCareOffice::class);
    }

    public function cancellations()
    {
        return $this->hasMany(Cancellation::class);
    }

    public function daycare_diaries()
    {
        return $this->hasMany(DaycareDiary::class);
    }

    public function getCareManagerEmail()
    {
        return optional($this->care_receiver)->getCareManagerEmail();
    }

    public function getNursingCareOfficeEmail()
    {
        return optional($this->nursing_care_office)->email;
    }

    public function getCareReceiverEmail()
    {
        return optional($this->care_receiver)->email;
    }

    public function getCareReceiverName()
    {
        return optional($this->care_receiver)->name;
    }

    public function getKeyPersonName()
    {
        return optional($this->care_receiver)->keyperson_name;
    }

    public function getNursingCareOfficeName()
    {
        return optional($this->nursing_care_office)->office_name;
    }
}
