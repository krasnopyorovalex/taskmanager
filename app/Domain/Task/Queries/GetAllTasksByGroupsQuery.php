<?php

declare(strict_types=1);

namespace Domain\Task\Queries;
use Domain\User\Queries\GetUsersWithMyGroupsQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

use App\Task;

/**
 * Class GetAllTasksByGroupsQuery
 * @package Domain\Task\Queries
 */
class GetAllTasksByGroupsQuery
{
    use DispatchesJobs;

    /**
     * Execute the job.
     */
    public function handle()
    {
        $groups = auth()->user()->groups()->get()->pluck('id')->toArray();
        $authors = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));

        return Task::actual()->with(['author' => static function ($query) {
            return $query->withTrashed();
        }, 'performer' => static function ($query) {
            return $query->withTrashed();
        }])->whereIn('author_id', $authors->pluck('id'))->paginate();
    }
}
