<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticate;

class Users extends Authenticate
{
    use HasFactory;

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
