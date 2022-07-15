<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareReceiver extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = ['birthday'];

    public function receivers()
    {
        return $this->hasMany(CareReceiver::class);
    }
}
