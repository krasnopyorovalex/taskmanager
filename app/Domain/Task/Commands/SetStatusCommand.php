<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class SetStatusCommand
 * @package Domain\Task\Commands
 */
class SetStatusCommand
{
    /**
     * @var string
     */
    private $uuid;
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;
    /**
     * @var string
     */
    private $status;
    /**
     * @var Task
     */
    private $task;

    /**
     * SetStatusCommand constructor.
     * @param Task $task
     * @param AbstractTaskStatus $taskStatus
     * @param string $status
     */
    public function __construct(Task $task, AbstractTaskStatus $taskStatus, string $status)
    {
        $this->taskStatus = $taskStatus;
        $this->status = $status;
        $this->task = $task;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {

        if ($this->taskStatus->inWork($this->task)) {
            $this->task->timer->updateTime($this->taskStatus->inWork($this->task));
        }

        return $this->task->update([
            'status' => $this->status
        ]);
    }
}
