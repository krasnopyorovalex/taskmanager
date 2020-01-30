<?php

declare(strict_types=1);

namespace Domain\Group\Commands;

use Domain\Group\Queries\GetGroupByIdQuery;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteGroupCommand
 * @package Domain\Group\Commands
 */
class DeleteGroupCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteGroupCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $group = $this->dispatch(new GetGroupByIdQuery($this->id));

        return $group->delete();
    }

}
