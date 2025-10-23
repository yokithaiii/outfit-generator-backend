<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'avatar',
        'tg_link',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'user_id', 'id');
    }
}
