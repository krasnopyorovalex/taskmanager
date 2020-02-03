<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UpdateTimersCommand
 * @package Domain\Task\Commands
 */
class UpdateTimersCommand
{
    /**
     * @var Collection
     */
    private $collection;
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * UpdateTimersCommand constructor.
     * @param Collection $collection
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(Collection $collection, AbstractTaskStatus $taskStatus)
    {
        $this->collection = $collection;
        $this->taskStatus = $taskStatus;
    }

    public function handle(): void
    {
        $taskStatus = $this->taskStatus;

        $this->collection->map(static function (Task $task) use ($taskStatus) {
            $task->timer->updateTime($taskStatus->inWork($task));
        });
    }
}
