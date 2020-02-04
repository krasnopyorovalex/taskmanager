<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\NewStoryHasAppeared;
use Domain\Task\Commands\CreateTaskCommand;
use Domain\Task\Commands\DeleteTaskCommand;
use Domain\Task\Entities\AbstractTaskStatus;
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
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * TaskController constructor.
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(AbstractTaskStatus $taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $tasks = $this->dispatch(new GetTasksByGroupsQuery($this->taskStatus));

        return view('tasks.index', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus
        ]);
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

        return view('tasks.show', [
            'task' => $task,
            'taskStatus' => $this->taskStatus
        ]);
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
        $task = $this->dispatch(new CreateTaskCommand($request));

        event(new NewStoryHasAppeared("Создана новая задача #{$task->name}"));

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
