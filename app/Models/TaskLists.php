<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskLists extends Model
{
    protected $table = 'task_lists';
    protected $fillable = [
        'name',
        'open_tasks',
        'completed_tasks',
        'position',
        'is_completed',
        'is_trashed',
    ];

    public $timestamps = true;

    protected $casts = [
        'is_completed' => 'boolean',
        'is_trashed' => 'boolean',
    ];
}
