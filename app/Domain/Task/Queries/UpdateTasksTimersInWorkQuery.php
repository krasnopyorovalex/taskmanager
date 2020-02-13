<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use Domain\Task\Entities\AbstractTaskStatus;
use App\Task;

/**
 * Class UpdateTasksTimersInWorkQuery
 * @package Domain\Task\Queries
 */
class UpdateTasksTimersInWorkQuery
{
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * UpdateTasksTimersInWorkQuery constructor.
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(AbstractTaskStatus $taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
       return Task::where('status', $this->taskStatus->onlyInWork())->get();
    }
}
