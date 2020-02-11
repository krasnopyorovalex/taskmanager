<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\User\Queries\GetUsersWithMyGroupsQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class GetCompletedTasksByGroupsQuery
 * @package Domain\Task\Queries
 */
class GetCompletedTasksByGroupsQuery
{
    use DispatchesJobs;

    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * GetCompletedTasksByGroupsQuery constructor.
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(AbstractTaskStatus $taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $groups = auth()->user()->onlyMyGroups();
        $authors = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));

        $query = Task::where('status', $this->taskStatus->onlyCompleted())->with(['author' => static function ($query) {
            return $query->withTrashed();
        }, 'performer' => static function ($query) {
            return $query->withTrashed();
        }])->where(static function ($query) use ($authors) {
            return $query->whereIn('author_id', $authors->pluck('id'))
                ->orWhere('author_id', auth()->user()->id);
        });

        return $query->paginate();
    }
}
