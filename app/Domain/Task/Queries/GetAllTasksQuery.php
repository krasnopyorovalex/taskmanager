<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Task;

/**
 * Class GetAllTasksQuery
 * @package Domain\Task\Queries
 */
class GetAllTasksQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Task::actual()->with(['author' => static function ($query) {
            return $query->withTrashed();
        }, 'performer' => static function ($query) {
            return $query->withTrashed();
        }])->paginate();
    }
}
