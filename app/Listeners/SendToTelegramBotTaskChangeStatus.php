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
     * @param TaskStatusChanged $event
     * @param AbstractTaskStatus $taskStatus
     */
    public function handle(TaskStatusChanged $event, AbstractTaskStatus $taskStatus): void
    {
        $this->dispatch(new SendRequestByChangeTaskStatusJob($event, $taskStatus));
    }
}
