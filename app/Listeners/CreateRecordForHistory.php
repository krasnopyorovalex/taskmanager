<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewStoryHasAppeared;
use Domain\History\Commands\CreateHistoryCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CreateRecordForHistory
 * @package App\Listeners
 */
class CreateRecordForHistory
{
    use DispatchesJobs;

    /**
     * @param NewStoryHasAppeared $event
     */
    public function handle(NewStoryHasAppeared $event): void
    {
        $this->dispatch(new CreateHistoryCommand($event));
    }
}
