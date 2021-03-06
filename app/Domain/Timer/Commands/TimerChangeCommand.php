<?php

declare(strict_types=1);

namespace Domain\Timer\Commands;

use App\Task;
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
     * TimerChangeCommand constructor.
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
    public function handle(): void
    {
        $timer = $this->task->timer;

        if ($this->taskStatus->inWork($this->task)) {
            $timer->stop();
        } elseif ($this->taskStatus->isPaused($this->task)) {
            $timer->start();
        }
    }
}
