<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Scopes\WithUsersByMyGroupsScope;
use App\Task;

/**
 * Class GetTaskByUuidWithTimerQuery
 * @package Domain\Task\Queries
 */
class GetTaskByUuidWithTimerQuery
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * GetTaskByUuidWithTimerQuery constructor.
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Task::withoutGlobalScope(WithUsersByMyGroupsScope::class)
            ->where('uuid', $this->uuid)
            ->with(['timer'])
            ->firstOrFail();
    }
}
