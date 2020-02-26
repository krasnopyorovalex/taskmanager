<?php

declare(strict_types=1);

namespace Domain\Timer\Commands;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class UpdateTimerForInWorkTaskCommand
 * @package Domain\Timer\Commands
 */
class UpdateTimerForInWorkTaskCommand
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
     * UpdateTimerForInWorkTaskCommand constructor.
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
        if ($this->taskStatus->inWork($this->task)) {
            $this->task->timer->stop();
        }
    }
}
