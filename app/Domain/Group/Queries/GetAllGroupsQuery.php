<?php

declare(strict_types=1);

namespace Domain\Group\Queries;

use App\Group;

/**
 * Class GetAllGroupsQuery
 * @package Domain\Group\Queries
 */
class GetAllGroupsQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return Group::all();
    }
}
