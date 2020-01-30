<?php

declare(strict_types=1);

namespace Domain\Group\Queries;

use App\Group;

/**
 * Class GetGroupByIdQuery
 * @package Domain\Group\Queries
 */
class GetGroupByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetGroupByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Group::findOrFail($this->id);
    }
}
