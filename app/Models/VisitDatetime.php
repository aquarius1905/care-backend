<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class VisitDatetime extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $dates = ['date', 'time'];

    protected $hidden = ['created_at', 'updated_at'];

    public function care_receiver()
    {
        return $this->belongsTo(CareReceiver::class);
    }

    public function getEmail()
    {
        return optional($this->care_receiver->email);
    }

    public function getKeyPersonName()
    {
        return optional($this->care_receiver->keyperson_name);
    }

    public function getCareReceiverName()
    {
        return optional($this->care_receiver)->name();
    }

    public function getCareManagerName()
    {
        return optional($this->care_receiver)->getCareManagerName();
    }

    public function getFormattedVisitDate()
    {
        Carbon::setLocale('ja');
        $carbon_date = Carbon::parse($this->date);
        return $carbon_date->isoFormat('YYYY年MM月DD日（ddd）');
    }
}
