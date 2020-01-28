<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Timer
 * @package App
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $total
 * @property integer $job_start
 */
class Timer extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the task that owns the timer.
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
    public function getFormatTotalAttribute(): string
    {
        $hours = (int)($this->total/3600) > 0 ? (int)($this->total/3600) . '<span>ч</span>' : '';
        $minutes = ($this->total/60)%60 > 0 ? ($this->total/60)%60 . '<span>мин</span>' : '';

        return sprintf('%s %s', $hours, $minutes);
    }
}
