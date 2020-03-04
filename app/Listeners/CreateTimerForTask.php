<?php

declare(strict_types=1);

namespace App\Listeners;

use Domain\Task\Events\TaskCreated;
use Domain\Timer\Commands\CreateTimerCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateTimerForTask
 * @package App\Listeners
 */
class CreateTimerForTask
{
    use DispatchesJobs;

    /**
     * @param TaskCreated $event
     */
    public function handle(TaskCreated $event): void
    {
        $this->dispatch(new CreateTimerCommand($event));
    }
}
