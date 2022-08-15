<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitDatetime extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    protected $dates = ['date', 'time'];

    public function care_receiver()
    {
        return $this->belongsTo(CareReceiver::class);
    }

    public function getKeyPersonEmail()
    {
        return optional($this->care_receiver)->getKeyPersonEmail();
    }

    public function getKeyPersonName()
    {
        return optional($this->care_receiver)->getKeyPersonName();
    }

    public function getCareReceiverName()
    {
        return optional($this->care_receiver)->name();
    }

    public function getCareManagerName()
    {
        return optional($this->care_receiver)->getCareManagerName();
    }
}
