<?php

declare(strict_types=1);

namespace Domain\Task\Entities\Implementation;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class TaskStatus
 * @package Domain\Task\DataMaps
 */
class TaskStatus extends AbstractTaskStatus
{
    private const TASK_NEW_STATUS = 'NEW';
    private const TASK_IN_WORK_STATUS = 'IN_WORK';
    private const TASK_PAUSED_STATUS = 'PAUSED';
    private const TASK_COMPLETED_STATUS = 'COMPLETED';
    private const TASK_CLOSED_STATUS = 'CLOSED';

    private const ICON_PLAY = 'icon-play';
    private const ICON_PAUSE = 'icon-pause';

    private $labels = [
        self::TASK_NEW_STATUS => 'новая',
        self::TASK_IN_WORK_STATUS => 'в работе',
        self::TASK_PAUSED_STATUS => 'приостановлена',
        self::TASK_COMPLETED_STATUS => 'выполнена',
        self::TASK_CLOSED_STATUS => 'закрыта'
    ];

    private const STATUSES_STEPS_MAP = [
        self::TASK_IN_WORK_STATUS => self::TASK_COMPLETED_STATUS,
        self::TASK_PAUSED_STATUS => self::TASK_COMPLETED_STATUS,
        self::TASK_COMPLETED_STATUS => self::TASK_CLOSED_STATUS,
        self::TASK_NEW_STATUS => self::TASK_COMPLETED_STATUS
    ];

    /**
     * @return array
     */
    public function onlyActual(): array
    {
        return [self::TASK_NEW_STATUS, self::TASK_IN_WORK_STATUS, self::TASK_PAUSED_STATUS];
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function isActual($task): bool
    {
        return in_array($task->status, $this->onlyActual(), true);
    }

    /**
     * @param Task $task
     * @return string
     */
    public function changeStatusByNewComment(Task $task): string
    {
        return ! $this->isActual($task) ? self::TASK_NEW_STATUS : $task->status;
    }

    /**
     * @return string
     */
    public function onlyInWork(): string
    {
        return self::TASK_IN_WORK_STATUS;
    }

    /**
     * @return string
     */
    public function onlyCompleted(): string
    {
        return self::TASK_COMPLETED_STATUS;
    }

    /**
     * @return string
     */
    public function onlyClosed(): string
    {
        return self::TASK_CLOSED_STATUS;
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function inWork(Task $task): bool
    {
        return $task->status === self::TASK_IN_WORK_STATUS;
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function isNew(Task $task): bool
    {
        return $task->status === self::TASK_NEW_STATUS;
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function inPause(Task $task): bool
    {
        return $task->status === self::TASK_PAUSED_STATUS;
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function isPaused(Task $task): bool
    {
        return $this->inPause($task) || $this->isCompleted($task) || $this->isNew($task);
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function isCompleted(Task $task): bool
    {
        return $task->status === self::TASK_COMPLETED_STATUS;
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function isClosed(Task $task): bool
    {
        return $task->status === self::TASK_CLOSED_STATUS;
    }

    /**
     * @param Task $task
     * @return string
     */
    public function getLabelStatus(Task $task): string
    {
        return $this->labels[$task->status];
    }

    /**
     * @return string
     */
    public function getCompletedStatus(): string
    {
        return self::TASK_COMPLETED_STATUS;
    }

    /**
     * @param Task $task
     * @return string
     */
    public function getNextStatus(Task $task): string
    {
        return self::STATUSES_STEPS_MAP[$task->status];
    }

    /**
     * @param Task $task
     * @return string
     */
    public function changeStatus(Task $task): string
    {
        return $this->inWork($task) ? self::TASK_PAUSED_STATUS : self::TASK_IN_WORK_STATUS;
    }

    /**
     * @param Task $task
     * @return string
     */
    public function icon(Task $task): string
    {
        return $this->inWork($task) ? (string) svg(self::ICON_PAUSE) : (string) svg(self::ICON_PLAY);
    }

    /**
     * @param Task $task
     * @return bool
     */
    public function isAuthor(Task $task): bool
    {
        return $task->author->id === auth()->user()->id;
    }
}
