<?php

declare(strict_types=1);

namespace App\Listeners;

use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Events\TaskCreated;
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
     * @param TaskCreated $event
     * @param AbstractTaskStatus $taskStatus
     */
    public function handle(TaskCreated $event, AbstractTaskStatus $taskStatus): void
    {
        $this->dispatch(new SendRequestByChangeTaskStatusJob($event, $taskStatus));
    }
}
