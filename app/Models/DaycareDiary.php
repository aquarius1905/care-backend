<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DaycareDiary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['date'];

    protected $hidden = ['created_at', 'updated_at'];

    public function weekly_service_schedule()
    {
        return $this->belongsTo(WeeklyServiceSchedule::class);
    }

    public function rehabilitation_contents()
    {
        return $this->belongsToMany(
            RehabilitationContent::class,
            'daycare_rehabilitaions',
            'rehabilitation_content_id',
            'daycare_diary_id'
        );
    }

    public function getCareReceiverEmail()
    {
        return optional($this->weekly_service_schedule)->getCareReceiverEmail();
    }

    public function getCareReceiverName()
    {
        return optional($this->weekly_service_schedule)->getCareReceiverName();
    }

    public function getNursingCareOfficeEmail()
    {
        return optional($this->weekly_service_schedule)->getNursingCareOfficeEmail();
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
