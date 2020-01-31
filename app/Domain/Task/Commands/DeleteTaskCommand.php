<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteTaskCommand
 * @package Domain\Task\Commands
 */
class DeleteTaskCommand
{
    use DispatchesJobs;

    /**
     * @var Task
     */
    private $task;

    /**
     * DeleteTaskCommand constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function handle(): bool
    {
        return $this->task->delete();
    }
}
