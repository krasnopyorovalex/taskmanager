<?php

declare(strict_types=1);

namespace App\Events;

use App\Task;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TaskStatusChanged
 * @package App\Events
 */
class TaskStatusChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Task
     */
    public $task;

    /**
     * TaskStatusChanged constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
}
