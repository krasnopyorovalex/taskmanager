<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use Domain\Report\Dto\DatePeriodDto;
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
     * @var DatePeriodDto
     */
    private $datePeriod;

    /**
     * GetUpdateTasksTimersInWorkQuery constructor.
     * @param AbstractTaskStatus $taskStatus
     * @param ReportFilter $reportFilter
     * @param DatePeriodDto $datePeriod
     */
    public function __construct(AbstractTaskStatus $taskStatus, ReportFilter $reportFilter, DatePeriodDto $datePeriod)
    {
        $this->taskStatus = $taskStatus;
        $this->reportFilter = $reportFilter;
        $this->datePeriod = $datePeriod;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Task::where('status', $this->taskStatus->onlyClosed())
            ->whereBetween('closed_at', [$this->datePeriod->getDateStart(), "{$this->datePeriod->getDateStop()} 23:59:59"])
            ->byFilter($this->reportFilter)
            ->get();
    }
}
