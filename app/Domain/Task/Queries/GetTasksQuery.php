<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use Domain\Task\Entities\AbstractTaskStatus;
use App\Task;

/**
 * Class GetTasksQuery
 * @package Domain\Task\Queries
 */
class GetTasksQuery
{
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * GetTasksQuery constructor.
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
        return Task::whereIn('status', $this->taskStatus->onlyActual())->paginate();
    }
}
