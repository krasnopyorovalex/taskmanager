<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use Domain\User\Queries\GetUsersWithMyGroupsQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Task;

/**
 * Class GetTasksByGroupsQuery
 * @package Domain\Task\Queries
 */
class GetTasksByGroupsQuery
{
    use DispatchesJobs;
    /**
     * @var string|null
     */
    private $byStatus;
    /**
     * @var bool
     */
    private $paginate;

    /**
     * GetTasksByGroupsQuery constructor.
     * @param bool $paginate
     * @param string|null $byStatus
     */
    public function __construct(bool $paginate = true, ?string $byStatus = null)
    {
        $this->byStatus = $byStatus;
        $this->paginate = $paginate;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $groups = auth()->user()->groups()->get()->pluck('id')->toArray();
        $authors = $this->dispatch(new GetUsersWithMyGroupsQuery($groups));

        $query = Task::actual()->with(['author' => static function ($query) {
            return $query->withTrashed();
        }, 'performer' => static function ($query) {
            return $query->withTrashed();
        }])->where(static function ($query) use ($authors) {
            $query->whereIn('author_id', $authors->pluck('id'))
                ->orWhere('author_id', auth()->user()->id);
        });

        if (is_string($this->byStatus)) {
            $query->where('status', $this->byStatus);
        }

        return $this->paginate
            ? $query->paginate()
            : $query->get();
    }
}
