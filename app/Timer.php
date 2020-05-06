<?php

declare(strict_types=1);

namespace App;

use Domain\Task\Entities\AbstractTaskStatus;
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
     * start timer
     */
    public function start(): void
    {
        $this->update([
            'job_start' => time()
        ]);
    }

    /**
     * stop timer
     */
    public function stop(): void
    {
        $time = time();

        $total = $this->total + $time - $this->job_start;

        $this->update([
            'total' => $total,
            'job_start' => $time
        ]);
    }

    /**
     * @param AbstractTaskStatus $taskStatus
     * @return int
     */
    public function readTime(AbstractTaskStatus $taskStatus): int
    {
        return $taskStatus->inWork($this->task)
            ? time() - $this->job_start + $this->total
            : $this->total;
    }
}
