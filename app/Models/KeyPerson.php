<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class KeyPerson extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'name_furigana',
        'email',
        'password',
        'postcode',
        'address',
        'tel'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function carereceivers()
    {
        return $this->hasMany(CareReceiver::class);
    }
}
