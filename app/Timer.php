<?php

declare(strict_types=1);

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Timer
 *
 * @package App
 * @property integer $id
 * @property integer $task_id
 * @property integer $total
 * @property integer $job_start
 * @property-read string $format_total
 * @property-read Task $task
 * @mixin Eloquent
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
     * @param bool $taskStatus
     */
    public function updateTime(bool $taskStatus): void
    {
        $taskStatus
            ? $this->total += time() - $this->job_start
            : $this->job_start = time();
    }

    public function updateTimeOnlyInWork(): void
    {
        $time = time();

        $this->update([
            'total' => $this->total + $time - $this->job_start,
            'job_start' => $time
        ]);
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
