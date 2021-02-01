<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TaskStatusChanged;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Telegram\Jobs\SendRequestByChangeTaskStatusJob;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SendToTelegramBotTaskChangeStatus
 * @package App\Listeners
 */
class SendToTelegramBotTaskChangeStatus
{
    use DispatchesJobs;

    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * SendToTelegramBotTaskChangeStatus constructor.
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(AbstractTaskStatus $taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    /**
     * @param TaskStatusChanged $event
     */
    public function handle(TaskStatusChanged $event): void
    {
        $this->dispatch(new SendRequestByChangeTaskStatusJob($event, $this->taskStatus));
    }
}
