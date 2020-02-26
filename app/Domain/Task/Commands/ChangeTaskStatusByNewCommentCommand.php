<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class ChangeTaskStatusByNewCommentCommand
 * @package Domain\Task\Commands
 */
class ChangeTaskStatusByNewCommentCommand
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
     * ChangeTaskStatusByNewCommentCommand constructor.
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
        if (! $this->taskStatus->isActual($this->task)) {
            return $this->task->update([
                'status' => $this->taskStatus->changeStatusByNewComment($this->task),
                'closed_at' => null
            ]);
        }

        return true;
    }
}
