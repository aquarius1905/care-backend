<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public function nursing_care_offices()
    {
        return $this->hasMany(NursingCareOffice::class);
    }
}
