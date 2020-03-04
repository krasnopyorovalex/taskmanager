<?php

declare(strict_types=1);

namespace Domain\Task\Events;

use App\Task;
use Illuminate\Queue\SerializesModels;

/**
 * Class TaskCreated
 * @package Domain\Task\Events
 */
class TaskCreated
{
    use SerializesModels;

    /**
     * @var Task
     */
    public $task;

    /**
     * TaskCreated constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
