<?php

declare(strict_types=1);

namespace Domain\Timer\DataMaps;

use App\Task;
use App\User;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class DataMapForTimer
 * @package Domain\Timer\DataMaps
 */
class DataMapForTimer
{
    /**
     * @var Task
     */
    private $task;
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;
    /**
     * @var User
     */
    private $user;

    /**
     * DataMapForTimer constructor.
     * @param Task $task
     * @param AbstractTaskStatus $taskStatus
     * @param User $user
     */
    public function __construct(Task $task, AbstractTaskStatus $taskStatus, User $user)
    {
        $this->task = $task;
        $this->taskStatus = $taskStatus;
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'status' => $this->task->status,
            'icon' => $this->taskStatus->icon($this->task),
            'label' => $this->taskStatus->getLabelStatus($this->task),
            'time' => (string) format_seconds($this->task->timer->total),
            'performer' => $this->user->name
        ];
    }

    /**
     * @return array
     */
    public function toArrayTimer(): array
    {
        return [
            'key' => $this->task->uuid,
            'time' => (string) format_seconds($this->task->timer->total)
        ];
    }
}
