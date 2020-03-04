<?php

declare(strict_types=1);

namespace Domain\Timer\DataMaps;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class DataMapForTimers
 * @package Domain\Timer\DataMaps
 */
class DataMapForTimers
{
    /**
     * @var LengthAwarePaginator
     */
    private $tasks;
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * DataMapForTimers constructor.
     * @param LengthAwarePaginator $tasks
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(LengthAwarePaginator $tasks, AbstractTaskStatus $taskStatus)
    {
        $this->tasks = $tasks;
        $this->taskStatus = $taskStatus;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $taskStatus = $this->taskStatus;

        return $this->tasks->filter(static function (Task $task) use ($taskStatus) {
            return $taskStatus->inWork($task);
        })->map(static function (Task $task) {
            return [
                'key' => $task->uuid,
                'time' => (string) format_seconds($task->timer->total)
            ];
        })->toArray();
    }
}
