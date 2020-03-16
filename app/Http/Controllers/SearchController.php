<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Forms\SearchRequest;
use App\Services\SearchTasksService;
use Domain\Task\Entities\AbstractTaskStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    /**
     * @var SearchTasksService
     */
    private $searchTasks;
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * SearchController constructor.
     * @param SearchTasksService $searchTasks
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(SearchTasksService $searchTasks, AbstractTaskStatus $taskStatus)
    {
        $this->searchTasks = $searchTasks;
        $this->taskStatus = $taskStatus;
    }

    /**
     * @param SearchRequest $request
     * @return Factory|View
     */
    public function __invoke(SearchRequest $request)
    {
        $tasks = $this->searchTasks->search($request->get('keyword'), $this->taskStatus);

        return view('tasks.closed', ['tasks' => $tasks]);
    }
}
