<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\NewStoryHasAppeared;
use App\Services\ThumbCreatorService;
use App\Task;
use Domain\Task\Commands\CloseTaskCommand;
use Domain\Task\Commands\SetStatusCommand;
use Domain\Task\Commands\UpdateTaskCommand;
use Domain\Task\Queries\GetClosedTasksQuery;
use Domain\Task\Queries\GetCompletedTasksQuery;
use Domain\Task\Commands\CreateTaskCommand;
use Domain\Task\Commands\DeleteTaskCommand;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\GetTaskByUuidQuery;
use Domain\Task\Queries\GetTasksQuery;
use Domain\Task\Requests\CreateTaskRequest;
use Domain\Task\Requests\UpdateTaskRequest;
use Domain\Timer\Commands\UpdateTimerForInWorkTaskCommand;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
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
     * @var ThumbCreatorService
     */
    private $thumbCreator;

    /**
     * TaskController constructor.
     * @param AbstractTaskStatus $taskStatus
     * @param ThumbCreatorService $thumbCreator
     */
    public function __construct(AbstractTaskStatus $taskStatus, ThumbCreatorService $thumbCreator)
    {
        $this->taskStatus = $taskStatus;
        $this->thumbCreator = $thumbCreator;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $tasks = $this->dispatch(new GetTasksQuery($this->taskStatus));

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
        /** @var Task $task */
        $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

        $this->authorize('view', $task);

        $this->dispatch(new UpdateTimerForInWorkTaskCommand($task, $this->taskStatus));

        // оптимизирем количество запросов [https://reinink.ca/articles/optimizing-circular-relationships-in-laravel]
        $task->files->each->setRelation('task', $task);

        return view('tasks.show', [
            'task' => $task,
            'taskStatus' => $this->taskStatus
        ]);
    }

    /**
     * @param UpdateTaskRequest $request
     * @param string $uuid
     * @return Factory|JsonResponse|View
     */
    public function update(UpdateTaskRequest $request, string $uuid)
    {
        try {
            $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

            $this->authorize('update', $task);

            $this->dispatch(new UpdateTaskCommand($request, $task));
        } catch (Exception $exception) {
            return response()->json([
                'message' => (string) view('layouts.partials.notify', ['message' => $exception->getMessage()])
            ], 400);
        }

        return response()->json([
            'message' => (string) view('layouts.partials.notify', ['message' => __('task.update.success'), 'icon' => 'icon-mood-happy']),
            'deadline' => format_deadline($task->fresh()->deadline)
        ]);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('tasks.create', [
            'groups' => auth()->user()->onlyMyGroups()
        ]);
    }

    /**
     * @param CreateTaskRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateTaskRequest $request)
    {
        $task = $this->dispatch(new CreateTaskCommand($request, $this->thumbCreator));

        event(new NewStoryHasAppeared(__('task.created', ['task' => $task->name])));

        return redirect(route('tasks.index'))
            ->with('message', __('task.added'));
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

    /**
     * @param string $uuid
     * @return RedirectResponse|Redirector
     */
    public function complete(string $uuid)
    {
        try {
            $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

            $this->authorize('complete', $task);

            $this->dispatch(new SetStatusCommand($task, $this->taskStatus));
        } catch (Exception $exception) {
            return redirect(route('tasks.index'))->with('message', $exception->getMessage());
        }

        return redirect(route('tasks.completed'));
    }

    /**
     * @return Factory|View
     */
    public function completed()
    {
        $tasks = $this->dispatch(new GetCompletedTasksQuery($this->taskStatus));

        return view('tasks.completed', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus
        ]);
    }

    /**
     * @param string $uuid
     * @return RedirectResponse|Redirector
     */
    public function close(string $uuid)
    {
        try {
            $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

            $this->dispatch(new CloseTaskCommand($task, $this->taskStatus));
        } catch (Exception $exception) {
            return redirect(route('tasks.index'))->with('message', $exception->getMessage());
        }

        return redirect(route('tasks.closed'));
    }

    /**
     * @return Factory|View
     */
    public function closed()
    {
        $tasks = $this->dispatch(new GetClosedTasksQuery($this->taskStatus));

        return view('tasks.closed', [
            'tasks' => $tasks,
            'taskStatus' => $this->taskStatus
        ]);
    }
}
