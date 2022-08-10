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
}
