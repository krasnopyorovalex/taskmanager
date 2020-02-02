<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;

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
     * ChangeTaskStatusCommand constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $this->task->inWork()
            ? $this->task->status = 'PAUSED'
            : $this->task->status = 'IN_WORK';

        return $this->task->save();
    }
}
