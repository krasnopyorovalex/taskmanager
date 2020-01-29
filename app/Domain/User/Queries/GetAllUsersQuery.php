<?php

declare(strict_types=1);

namespace Domain\User\Queries;

use App\User;

/**
 * Class GetAllUsersQuery
 * @package Domain\User\Queries
 */
class GetAllUsersQuery
{
    /**
     * Execute the job.
     */
    public function handle()
    {
        return User::paginate();
    }
}
