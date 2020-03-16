<?php

declare(strict_types=1);

namespace Domain\Task\Queries;

use App\Task;
use Domain\Task\Entities\AbstractTaskStatus;

/**
 * Class GetTasksByKeyword
 * @package Domain\Task\Queries
 */
class GetTasksByKeyword
{
    /**
     * @var string
     */
    private $keyword;
    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    /**
     * GetTasksByKeyword constructor.
     * @param string $keyword
     * @param AbstractTaskStatus $taskStatus
     */
    public function __construct(string $keyword, AbstractTaskStatus $taskStatus)
    {
        $this->keyword = $keyword;
        $this->taskStatus = $taskStatus;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        return Task::where('status', $this->taskStatus->onlyClosed())
            ->where(function ($query) {
                return $query->where('name', 'like', "%{$this->keyword}%")
                    ->orWhere('body', 'like', "%{$this->keyword}%");
            })
            ->paginate();
    }
}
