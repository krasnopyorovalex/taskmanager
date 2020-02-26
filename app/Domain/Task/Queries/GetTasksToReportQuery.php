<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Scopes\WithUsersByMyGroupsScope;
use Domain\Task\Entities\AbstractTaskStatus;
use App\Task;
use Illuminate\Support\Carbon;

/**
 * Class GetTasksToReportQuery
 * @package Domain\Task\Queries
 */
class GetTasksToReportQuery
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
        $date = Carbon::now();

       return Task::where('status', $this->taskStatus->onlyClosed())
           ->whereMonth('closed_at', $date)
           ->whereYear('closed_at', $date)
           ->get();
    }
}
