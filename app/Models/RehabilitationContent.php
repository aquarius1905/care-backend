<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RehabilitationContent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function daycare_diaries()
    {
        return $this->belongsToMany(
            DaycareDiary::class,
            'daycare_rehabilitaions',
            'daycare_diary_id',
            'rehabilitation_content_id'
        );
    }
}
