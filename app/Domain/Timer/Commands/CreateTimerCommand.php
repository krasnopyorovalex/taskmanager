<?php
declare(strict_types=1);

namespace App\Domain\Timer\Commands;

use App\Domain\Task\Events\TaskCreated;
use App\Timer;

/**
 * Class CreateTimerCommand
 * @package App\Domain\Timer\Commands
 */
class CreateTimerCommand
{
    private $task;

    /**
     * CreateTimerCommand constructor.
     * @param TaskCreated $task
     */
    public function __construct(TaskCreated $task)
    {
        $this->task = $task;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $timer = new Timer();
        $timer->fill(['task_id' => $this->task->id]);

        return $timer->save();
    }

}
