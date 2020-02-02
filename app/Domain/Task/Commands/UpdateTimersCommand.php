<?php

declare(strict_types=1);

namespace Domain\Task\Commands;

use App\Task;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class UpdateTimersCommand
 * @package Domain\Task\Commands
 */
class UpdateTimersCommand
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * UpdateTimersCommand constructor.
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function handle(): void
    {
        $this->collection->map(static function (Task $task) {
            $task->timer->updateTimeOnlyInWork();
        });
    }
}
