<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\TimeCalculator\AbstractTimeCalculatorService;
use Domain\Report\Dto\DatePeriodDto;
use Domain\Report\Filters\ReportFilter;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\GetTasksToReportQuery;
use Domain\User\Queries\GetUsersWithMyGroupsQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;
use PDF;

/**
 * Class ReportController
 * @package App\Http\Controllers
 */
class ReportController extends Controller
{
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;
    /**
     * @var AbstractTimeCalculatorService
     */
    private $timeCalculator;
    /**
     * @var ReportFilter
     */
    private $reportFilter;
    /**
     * @var string
     */
    private $datePeriod;

    /**
     * TaskController constructor.
     * @param AbstractTaskStatus $taskStatus
     * @param AbstractTimeCalculatorService $timeCalculator
     * @param ReportFilter $reportFilter
     */
    public function __construct(AbstractTaskStatus $taskStatus, AbstractTimeCalculatorService $timeCalculator, ReportFilter $reportFilter)
    {
        $this->taskStatus = $taskStatus;
        $this->timeCalculator = $timeCalculator;
        $this->reportFilter = $reportFilter;

        $dateStart = request('start') ?: today()->startOfMonth()->format('Y-m-d');
        $dateStop = request('stop') ?: today()->format('Y-m-d');
        $this->datePeriod = new DatePeriodDto($dateStart, $dateStop);
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $tasks = $this->dispatch(new GetTasksToReportQuery($this->taskStatus, $this->reportFilter, $this->datePeriod));

        $groups = auth()->user()->onlyMyGroups();

        $performers = $this->dispatch(new GetUsersWithMyGroupsQuery($groups->pluck('id')));

        return view('reports.index', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus,
            'timeCalculator' => $this->timeCalculator,
            'datePeriod' => $this->datePeriod,
            'performers' => $performers,
            'groups' => $groups
        ]);
    }

    /**
     * @return Response
     */
    public function pdf(): Response
    {
        $tasks = $this->dispatch(new GetTasksToReportQuery($this->taskStatus, $this->reportFilter, $this->datePeriod));

        $report = sprintf('отчёт_за_%s.pdf', date('d-m-Y'));

        return PDF::loadView('reports.pdf', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus,
            'timeCalculator' => $this->timeCalculator
        ])->download($report);
    }
}
