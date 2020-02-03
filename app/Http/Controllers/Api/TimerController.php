<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Domain\Task\Commands\ChangeTaskStatusCommand;
use App\Http\Controllers\Controller;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\GetTaskByUuidQuery;
use Domain\Timer\Commands\TimerChangeCommand;
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
     */
    public function __invoke(string $uuid)
    {
        $task = $this->dispatch(new GetTaskByUuidQuery($uuid));

        $this->dispatch(new TimerChangeCommand($task, $this->taskStatus));

        $this->dispatch(new ChangeTaskStatusCommand($task, $this->taskStatus));

        return response()->json([
            'status' => $task->status,
            'icon' => $this->taskStatus->icon($task),
            'label' => $this->taskStatus->getLabelStatus($task),
            'time' => (string) format_seconds($task->timer->total)
        ]);
    }
}
