<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Task\Queries\GetAllTasksQuery;
use Domain\Task\Queries\GetTaskByIdQuery;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class TaskController
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $tasks = $this->dispatch(new GetAllTasksQuery());

        return view('tasks.index', compact('tasks'));
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function show(int $id)
    {
        $task = $this->dispatch(new GetTaskByIdQuery($id));

        return view('tasks.show', compact('task'));
    }
}
