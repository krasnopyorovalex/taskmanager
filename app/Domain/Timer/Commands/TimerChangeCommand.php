<?php

declare(strict_types=1);

namespace Domain\Timer\Commands;

use App\Task;
use App\Timer;

/**
 * Class TimerChangeCommand
 * @package Domain\Timer\Commands
 */
class TimerChangeCommand
{
    /**
     * @var Task
     */
    private $task;

    /**
     * TimerChangeQuery constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     */
    public function handle(): bool
    {
        $timer = $this->task->timer;

        $timer->updateTime($this->task->inWork());

        return $timer->save();
    }
}
