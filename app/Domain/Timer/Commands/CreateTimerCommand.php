<?php

declare(strict_types=1);

namespace Domain\Timer\Commands;

use Domain\Task\Events\TaskCreated;
use App\Timer;

/**
 * Class CreateTimerCommand
 * @package Domain\Timer\Commands
 */
class CreateTimerCommand
{
    private $event;

    /**
     * CreateTimerCommand constructor.
     * @param TaskCreated $event
     */
    public function __construct(TaskCreated $event)
    {
        $this->event = $event;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $timer = new Timer();
        $timer->fill(['task_id' => $this->event->task->id]);

        return $timer->save();
    }

}
