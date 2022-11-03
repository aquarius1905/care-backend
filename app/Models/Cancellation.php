<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cancellation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['date'];

    protected $hidden = [
        'weekly_service_schedule_id',
        'created_at',
        'updated_at'
    ];

    public function weekly_service_schedule()
    {
        return $this->belongsTo(WeeklyServiceSchedule::class);
    }

    public function getCareManagerEmail()
    {
        return optional($this->weekly_service_schedule)->getCareManagerEmail();
    }

    public function getNursingCareOfficeEmail()
    {
        return optional($this->weekly_service_schedule)->getNursingCareOfficeEmail();
    }

    public function getCareReceiverEmail()
    {
        return optional($this->weekly_service_schedule)->getCareReceiverEmail();
    }

    public function getCareReceiverName()
    {
        return optional($this->weekly_service_schedule)->getCareReceiverName();
    }

    public function getKeyPersonName()
    {
        return optional($this->weekly_service_schedule)->getKeyPersonName();
    }

    public function getNursingCareOfficeName()
    {
        return optional($this->weekly_service_schedule)->getNursingCareOfficeName();
    }

    public function getFormattedDate()
    {
        Carbon::setLocale('ja');
        $date = Carbon::parse($this->date);
        return $date->isoFormat('YYYY年MM月DD日（ddd）');
    }
}
