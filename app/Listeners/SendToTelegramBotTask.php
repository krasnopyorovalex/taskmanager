<?php

declare(strict_types=1);

namespace App\Listeners;

use Domain\Task\Events\TaskCreated;
use Domain\Telegram\Jobs\SendRequestByNewTaskJob;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SendToTelegramBotTask
 * @package App\Listeners
 */
class SendToTelegramBotTask
{
    use DispatchesJobs;

    /**
     * @param TaskCreated $event
     */
    public function handle(TaskCreated $event): void
    {
        $this->dispatch(new SendRequestByNewTaskJob($event));
    }
}
