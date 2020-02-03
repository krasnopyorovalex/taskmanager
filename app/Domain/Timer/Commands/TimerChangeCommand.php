<?php

declare(strict_types=1);

namespace Domain\Timer\Commands;

use App\Task;
use App\Timer;
use Domain\Task\Entities\AbstractTaskStatus;

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
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * TimerChangeQuery constructor.
     * @param Task $task
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(Task $task, AbstractTaskStatus $taskStatus)
    {
        $this->task = $task;
        $this->taskStatus = $taskStatus;
    }

    /**
     * Execute the job.
     */
    public function handle(): bool
    {
        $timer = $this->task->timer;

        $timer->updateTime($this->taskStatus->inWork($this->task));

        return $timer->save();
    }
}
