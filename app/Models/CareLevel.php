<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareLevel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function carereceivers()
    {
        return $this->hasMany(CareReceiver::class);
    }
}
