<?php

namespace App\Http\Controllers;

use App\Domain\Task\Queries\GetAllTasksQuery;
use App\Domain\Task\Queries\GetTaskByIdQuery;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = $this->dispatch(new GetAllTasksQuery());

        return view('tasks.index', compact('tasks'));
    }

    public function show(int $id)
    {
        $task = $this->dispatch(new GetTaskByIdQuery($id));

        return view('tasks.show', compact('task'));
    }
}
