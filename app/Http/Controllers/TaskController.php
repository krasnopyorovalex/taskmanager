<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Domain\Task\Commands\CreateTaskCommand;
use Domain\Task\Commands\DeleteTaskCommand;
use Domain\Task\Queries\GetTaskByUuidQuery;
use Domain\Task\Queries\GetTasksByGroupsQuery;
use Domain\Task\Requests\CreateTaskRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
        $tasks = $this->dispatch(new GetTasksByGroupsQuery());

        return view('tasks.index', compact('tasks'));
    }

    /**
     * @param string $uuid
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(string $uuid)
    {
        $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * @param CreateTaskRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateTaskRequest $request)
    {
        $this->dispatch(new CreateTaskCommand($request));

        return redirect(route('tasks.index'))
            ->with('message', 'Новая задача добавлена');
    }

    /**
     * @param string $uuid
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function destroy(string $uuid)
    {
        $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

        $this->authorize('delete', $task);

        $this->dispatch(new DeleteTaskCommand($task));

        return redirect(route('tasks.index'));
    }
}
