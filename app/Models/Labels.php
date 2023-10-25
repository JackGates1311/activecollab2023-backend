<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Labels extends Model
{
    protected $table = 'labels';
    protected $fillable = [
        'color',
    ];

    public $timestamps = true;
}
