<?php

declare(strict_types=1);

namespace Domain\User\Queries;

use App\User;

/**
 * Class GetUsersWithMyGroupsQuery
 * @package Domain\User\Queries
 */
class GetUsersWithMyGroupsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return User::select(['id', 'name'])->whereHas('tasksByPerformer')->get();
    }
}
