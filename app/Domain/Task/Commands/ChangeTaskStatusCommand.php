<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use App\User;
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
     * @var User
     */
    private $user;

    /**
     * ChangeTaskStatusCommand constructor.
     * @param Task $task
     * @param AbstractTaskStatus $taskStatus
     * @param User $user
     */
    public function __construct(Task $task, AbstractTaskStatus $taskStatus, User $user)
    {
        $this->task = $task;
        $this->taskStatus = $taskStatus;
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return $this->task->update([
            'status' => $this->taskStatus->changeStatus($this->task),
            'performer_id' => $this->task->performer
                ? $this->task->performer->id
                : $this->user->id
        ]);
    }
}
