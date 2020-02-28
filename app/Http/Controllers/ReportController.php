<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\TimeCalculator\AbstractTimeCalculatorService;
use Domain\Report\Filters\ReportFilter;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\GetTasksToReportQuery;
use Domain\User\Queries\GetUsersWithMyGroupsQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
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
    private $startedAt;
    /**
     * @var string
     */
    private $stopAt;

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

        $this->startedAt = request('startedAt') ?: Carbon::today()->startOfMonth()->format('Y-m-d');
        $this->stopAt = request('stopAt') ?: Carbon::today()->format('Y-m-d');
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $tasks = $this->dispatch(new GetTasksToReportQuery($this->taskStatus, $this->reportFilter, $this->startedAt, $this->stopAt));

        $groups = auth()->user()->onlyMyGroups();
        $performers = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));

        return view('reports.index', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus,
            'timeCalculator' => $this->timeCalculator,
            'startedAt' => $this->startedAt,
            'stopAt' => $this->stopAt,
            'performers' => $performers
        ]);
    }

    /**
     * @return Response
     */
    public function pdf(): Response
    {
        $tasks = $this->dispatch(new GetTasksToReportQuery($this->taskStatus, $this->reportFilter, $this->startedAt, $this->stopAt));

        $report = sprintf('отчёт_за_%s.pdf', date('d-m-Y'));

        return PDF::loadView('reports.pdf', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus,
            'timeCalculator' => $this->timeCalculator
        ])->download($report);
    }
}
