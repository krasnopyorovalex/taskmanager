<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class GetCompletedTasksQuery
 * @package Domain\Task\Queries
 */
class GetCompletedTasksQuery
{
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * GetCompletedTasksQuery constructor.
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
        return Task::where('status', $this->taskStatus->onlyCompleted())->paginate();
    }
}
