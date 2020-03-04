<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Carbon\Carbon;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class CloseTaskCommand
 * @package Domain\Task\Commands
 */
class CloseTaskCommand
{
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;
    /**
     * @var Task
     */
    private $task;

    /**
     * SetStatusCommand constructor.
     * @param Task $task
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(Task $task, AbstractTaskStatus $taskStatus)
    {
        $this->taskStatus = $taskStatus;
        $this->task = $task;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return $this->task->update([
            'closed_at' => Carbon::now(),
            'status' => $this->taskStatus->getNextStatus($this->task)
        ]);
    }
}
