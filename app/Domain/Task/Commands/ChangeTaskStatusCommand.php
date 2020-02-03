<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class ChangeTaskStatusCommand
 * @package Domain\Task\Commands
 */
class ChangeTaskStatusCommand
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
     * ChangeTaskStatusCommand constructor.
     * @param Task $task
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(Task $task, AbstractTaskStatus $taskStatus)
    {
        $this->task = $task;
        $this->taskStatus = $taskStatus;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return $this->task->update([
            'status' => $this->taskStatus->changeStatus($this->task)
        ]);
    }
}
