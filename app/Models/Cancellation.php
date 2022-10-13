<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancellation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['date'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $with = ['weekly_service_schedule'];

    public function weekly_service_schedule()
    {
        return $this->belongsTo(WeeklyServiceSchedule::class);
    }
}
