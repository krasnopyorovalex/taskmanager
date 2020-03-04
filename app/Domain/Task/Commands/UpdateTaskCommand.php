<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Domain\Task\Requests\UpdateTaskRequest;

/**
 * Class UpdateTaskCommand
 * @package Domain\Task\Commands
 */
class UpdateTaskCommand
{
    /**
     * @var Task
     */
    private $task;
    /**
     * @var UpdateTaskRequest
     */
    private $request;

    /**
     * UpdateTaskCommand constructor.
     * @param UpdateTaskRequest $request
     * @param Task $task
     */
    public function __construct(UpdateTaskRequest $request, Task $task)
    {
        $this->task = $task;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return $this->task->update([
            'deadline' => $this->request->post('deadline')
        ]);
    }
}
