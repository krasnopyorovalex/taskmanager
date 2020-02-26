<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Events\NewStoryHasAppeared;
use App\Task;
use App\User;
use Domain\Task\Commands\ChangeTaskStatusCommand;
use App\Http\Controllers\Controller;
use Domain\Task\Commands\CheckPerformerTaskCommand;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\GetTaskByUuidQuery;
use Domain\Task\Queries\GetTaskByUuidWithTimerQuery;
use Domain\Task\Queries\GetTasksQuery;
use Domain\Timer\Commands\TimerChangeCommand;
use Domain\Timer\DataMaps\DataMapForTimer;
use Domain\Timer\DataMaps\DataMapForTimers;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

/**
 * Class TimerController
 * @package App\Http\Controllers
 */
class TimerController extends Controller
{
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    public function __construct(AbstractTaskStatus $taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(string $uuid): JsonResponse
    {
        /** @var User $user*/
        $user = auth()->user();

        /** @var Task $task */
        $task = $this->dispatch(new GetTaskByUuidWithTimerQuery($uuid));
        $task->timer->setRelation('task', $task);

        $this->dispatch(new CheckPerformerTaskCommand($task, $user));

        $this->authorize('update', $task->fresh()->timer);

        $this->dispatch(new TimerChangeCommand($task, $this->taskStatus));

        $this->dispatch(new ChangeTaskStatusCommand($task, $this->taskStatus, $user));

        event(new NewStoryHasAppeared(__('task.status.change', ['task' => $task->name, 'status' => $this->taskStatus->getLabelStatus($task)])));

        return response()->json(
            (new DataMapForTimer($task->fresh(), $this->taskStatus, $user))->toArray()
        );
    }

    /**
     * @param string $uuid
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function timer(string $uuid): JsonResponse
    {
        /** @var User $user*/
        $user = auth()->user();

        $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

        $this->authorize('update', $task->timer);

        $this->dispatch(new TimerChangeCommand($task, $this->taskStatus));

        return response()->json(
            (new DataMapForTimer($task->fresh(), $this->taskStatus, $user))->toArrayTimer()
        );
    }

    /**
     * @return JsonResponse
     */
    public function timers(): JsonResponse
    {
        $tasks = $this->dispatch(new GetTasksQuery($this->taskStatus));

        return response()->json(
            (new DataMapForTimers($tasks, $this->taskStatus))->toArray()
        );
    }
}
