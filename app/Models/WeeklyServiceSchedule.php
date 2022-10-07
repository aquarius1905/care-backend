<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyServiceSchedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $dates = ['date', 'time'];

    public function care_receiver()
    {
        return $this->belongsTo(CareReceiver::class);
    }

    public function nursing_care_office()
    {
        return $this->belongsTo(NursingCareOffice::class);
    }
}
