<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use App\User;

/**
 * Class CheckPerformerTaskCommand
 * @package Domain\Task\Commands
 */
class CheckPerformerTaskCommand
{
    /**
     * @var Task
     */
    private $task;
    /**
     * @var User
     */
    private $user;

    /**
     * CheckPerformerTaskCommand constructor.
     * @param Task $task
     * @param User $user
     */
    public function __construct(Task $task, User $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    /**
     * handle job
     */
    public function handle(): void
    {
        if (! $this->task->performer) {
            $this->task->update([
                'performer_id' => $this->user->id
            ]);
        }
    }
}
