<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\TimeCalculator\AbstractTimeCalculatorService;
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
     * TaskController constructor.
     * @param AbstractTaskStatus $taskStatus
     * @param AbstractTimeCalculatorService $timeCalculator
     */
    public function __construct(AbstractTaskStatus $taskStatus, AbstractTimeCalculatorService $timeCalculator)
    {
        $this->taskStatus = $taskStatus;
        $this->timeCalculator = $timeCalculator;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $firstDayOfCurrentMonth = Carbon::today()->startOfMonth()->format('Y-m-d');

        $tasks = $this->dispatch(new GetTasksToReportQuery($this->taskStatus));

        $groups = auth()->user()->onlyMyGroups();
        $performers = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));

        return view('reports.index', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus,
            'timeCalculator' => $this->timeCalculator,
            'firstDayOfCurrentMonth' => $firstDayOfCurrentMonth,
            'performers' => $performers
        ]);
    }

    /**
     * @return Response
     */
    public function pdf(): Response
    {
        $tasks = $this->dispatch(new GetTasksToReportQuery($this->taskStatus));

        $report = sprintf('отчёт_за_%s.pdf', date('d-m-Y'));

        return PDF::loadView('reports.pdf', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus,
            'timeCalculator' => $this->timeCalculator
        ])->download($report);
    }
}
