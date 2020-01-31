<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Task;

/**
 * Class GetTaskByUuidQuery
 * @package Domain\Task\Queries
 */
class GetTaskByUuidQuery
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
     * Execute the job.
     */
    public function handle()
    {
        return Task::where('uuid', $this->uuid)->with(['author' => static function ($query) {
            return $query->withTrashed();
        }, 'performer' => static function ($query) {
            return $query->withTrashed();
        }, 'comments'])->firstOrFail();
    }
}
