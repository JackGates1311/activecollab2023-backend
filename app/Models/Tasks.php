<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static find(int $int)
 * @method static create(array $all)
 */
class Tasks extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'name',
        'is_completed',
        'task_list_id',
        'position',
        'start_on',
        'due_on',
        'labels',
        'open_subtasks',
        'comments_count',
        'assignee',
        'is_important',
        'completed_on',
    ];

    public $timestamps = true;

    // Task.php
    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Labels::class, 'label_task',
            'task_id', 'label_id');
    }

    public function assignees(): BelongsToMany
    {
        return $this->belongsToMany(Users::class, 'assignee_task',
            'task_id', 'assignee_id');
    }

    protected $casts = [
        'is_completed' => 'boolean',
        'is_important' => 'boolean',
    ];

}
