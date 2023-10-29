<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method where(string $string, mixed $email)
 */
class Users extends Authenticate
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'username',
        'password',
        'avatar_url',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}
