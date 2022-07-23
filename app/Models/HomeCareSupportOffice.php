<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCareSupportOffice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function caremanagers()
    {
        return $this->hasMany(CareManager::class);
    }
}
