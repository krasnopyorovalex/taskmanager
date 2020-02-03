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
        $time = time();

        $total = $taskStatus ? $this->total + $time - $this->job_start : $this->total;
        $jobStart = $taskStatus ? $this->job_start : $time;

        $this->update([
            'total' => $total,
            'job_start' => $jobStart
        ]);
    }
}
