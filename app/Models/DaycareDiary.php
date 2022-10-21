<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaycareDiary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['date'];

    protected $hidden = ['created_at', 'updated_at'];

    public function care_receiver()
    {
        return $this->belongsTo(CareReceiver::class);
    }

    public function nursing_care_office()
    {
        return $this->belongsTo(NursingCareOffice::class);
    }
}
