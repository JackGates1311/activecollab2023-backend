<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $all)
 * @method static find(mixed $id)
 * @method static max(string $string)
 */
class TaskLists extends Model
{
    use HasFactory;

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

    public function tasks(): HasMany
    {
        return $this->HasMany(Tasks::class, 'task_list_id', 'id');
    }

    protected $casts = [
        'is_completed' => 'boolean',
        'is_trashed' => 'boolean',
    ];
}
