<?php

declare(strict_types=1);

namespace Domain\User\Queries;

use App\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GetUsersWithMyGroupsQuery
 * @package Domain\User\Queries
 */
class GetUsersWithMyGroupsQuery
{
    /**
     * @var array
     */
    private $groups;

    public function __construct(array $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $groups = $this->groups;

        return User::select(['id', 'name'])->whereHas('groups', static function (Builder $query) use ($groups) {
            $query->whereIn('id', $groups);
        })->get();
    }
}
