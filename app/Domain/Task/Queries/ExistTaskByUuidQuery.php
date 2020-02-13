<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Scopes\WithUsersByMyGroupsScope;
use App\Task;

/**
 * Class ExistTaskByUuidQuery
 * @package Domain\Task\Queries
 */
class ExistTaskByUuidQuery
{
    /**
     * @var string
     */
    private $uuid;

    /**
     * GetTaskByUuidQuery constructor.
     * @param string $uuid
     */
    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return Task::withoutGlobalScope(WithUsersByMyGroupsScope::class)
            ->where('uuid', $this->uuid)
            ->exist();
    }
}
