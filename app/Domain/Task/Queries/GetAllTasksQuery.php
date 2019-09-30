<?php

declare(strict_types=1);

namespace App\Domain\Task\Queries;

use App\Task;

/**
 * Class GetAllTasksQuery
 * @package App\Domain\Task\Queries
 */
class GetAllTasksQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Task::paginate();
    }
}
