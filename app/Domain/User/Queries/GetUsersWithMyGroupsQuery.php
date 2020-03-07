<?php

declare(strict_types=1);

namespace Domain\User\Queries;

use App\User;
use Illuminate\Support\Collection;

/**
 * Class GetUsersWithMyGroupsQuery
 * @package Domain\User\Queries
 */
class GetUsersWithMyGroupsQuery
{
    /**
     * @return Collection
     */
    public function handle(): Collection
    {
        return User::select(['id', 'name'])->get();
    }
}
