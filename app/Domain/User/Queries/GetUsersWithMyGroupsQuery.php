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
     * @var Collection
     */
    private $groups;

    /**
     * GetUsersWithMyGroupsQuery constructor.
     * @param Collection $groups
     */
    public function __construct(Collection $groups)
    {
        $this->groups = $groups;
    }

    /**
     * @return Collection
     */
    public function handle(): Collection
    {
        return User::select(['id', 'name'])->whereHas('tasksByPerformer', function ($query) {
            return $query->whereIn('group_id', $this->groups);
        })->get();
    }
}
