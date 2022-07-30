<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareReceiver extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['birthday'];

    public function care_level()
    {
        return $this->belongsTo(CareLevel::class);
    }

    public function care_manager()
    {
        return $this->belongsTo(CareManager::class);
    }

    public function key_person()
    {
        return $this->belongsTo(KeyPerson::class);
    }
}
