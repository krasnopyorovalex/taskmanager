<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Task;

/**
 * Class GetTaskByIdQuery
 * @package Domain\Article\Queries
 */
class GetTaskByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetTaskByIdQuery constructor.
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
        return Task::with(['author' => static function ($query) {
            return $query->withTrashed();
        }, 'performer' => static function ($query) {
            return $query->withTrashed();
        }])->findOrFail($this->id);
    }
}
