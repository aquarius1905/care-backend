<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareReceiver extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['birthday'];

    public function carelevel()
    {
        return $this->belongsTo(CareLevel::class);
    }
    public function caremanager()
    {
        return $this->belongsTo(CareManager::class);
    }
}
