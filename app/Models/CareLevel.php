<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareLevel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function care_receivers()
    {
        return $this->hasMany(CareReceiver::class);
    }
}
