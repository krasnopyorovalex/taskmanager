<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class File
 *
 * @package App
 * @property int $id
 * @property int $task_id
 * @property string $name
 * @property string $path
 * @property int $is_image
 * @property-read \App\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\File whereTaskId($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'is_image' => 'boolean'
    ];

    /**
     * Get the task that owns the file.
     *
     * @return BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return asset(str_replace('public', 'storage', $this->path));
    }

    /**
     * @return string
     */
    public function thumb(): string
    {
        return asset(str_replace(['public', '.'], ['storage', '_thumb.'], $this->path));
    }
}
