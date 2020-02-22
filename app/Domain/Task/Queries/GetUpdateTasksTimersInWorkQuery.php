<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use Domain\Task\Entities\AbstractTaskStatus;
use App\Task;

/**
 * Class GetUpdateTasksTimersInWorkQuery
 * @package Domain\Task\Queries
 */
class GetUpdateTasksTimersInWorkQuery
{
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * GetUpdateTasksTimersInWorkQuery constructor.
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
