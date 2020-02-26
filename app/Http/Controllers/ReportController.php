<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\TimeCalculator\AbstractTimeCalculatorService;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\GetTasksToReportQuery;
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
        $tasks = $this->dispatch(new GetTasksToReportQuery($this->taskStatus));

        return view('reports.index', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus,
            'timeCalculator' => $this->timeCalculator
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
