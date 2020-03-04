<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class GetClosedTasksQuery
 * @package Domain\Task\Queries
 */
class GetClosedTasksQuery
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
     * @return mixed
     */
    public function handle()
    {
        return Task::where('status', $this->taskStatus->onlyClosed())->paginate();
    }
}
