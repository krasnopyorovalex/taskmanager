<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use Domain\Report\Filters\ReportFilter;
use Domain\Task\Entities\AbstractTaskStatus;
use App\Task;

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
     * @var ReportFilter
     */
    private $reportFilter;
    /**
     * @var string
     */
    private $startedAt;
    /**
     * @var string
     */
    private $stopAt;

    /**
     * GetUpdateTasksTimersInWorkQuery constructor.
     * @param AbstractTaskStatus $taskStatus
     * @param ReportFilter $reportFilter
     * @param string $startedAt
     * @param string $stopAt
     */
    public function __construct(AbstractTaskStatus $taskStatus, ReportFilter $reportFilter, string $startedAt, string $stopAt)
    {
        $this->taskStatus = $taskStatus;
        $this->reportFilter = $reportFilter;
        $this->startedAt = $startedAt;
        $this->stopAt = $stopAt;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Task::where('status', $this->taskStatus->onlyClosed())
            ->whereBetween('closed_at', ["{$this->startedAt} 23:59:59", "{$this->stopAt} 23:59:59"])
            ->byFilter($this->reportFilter)
            ->get();
    }
}
