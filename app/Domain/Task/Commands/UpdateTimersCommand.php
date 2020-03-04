<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Timer\Commands\UpdateTimerForInWorkTaskCommand;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateTimersCommand
 * @package Domain\Task\Commands
 */
class UpdateTimersCommand
{
    use DispatchesJobs;

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
        $this->collection->map(function (Task $task) {
            $this->dispatch(new UpdateTimerForInWorkTaskCommand($task, $this->taskStatus));
        });
    }
}
