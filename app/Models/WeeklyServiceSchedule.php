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

    protected $with = ['nursing_care_office'];

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
        return $this->belongsTo(WeeklyServiceSchedule::class);
    }
}
