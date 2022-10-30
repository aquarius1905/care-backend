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

    protected $casts = [
        'rehabilitations'  => 'json',
    ];

    public function weekly_service_schedule()
    {
        return $this->belongsTo(WeeklyServiceSchedule::class);
    }
}
