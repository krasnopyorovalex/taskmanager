<?php

declare(strict_types=1);

namespace App\Services;

use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\GetTasksByKeyword;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class SearchTasksService
 * @package App\Services
 */
class SearchTasksService
{
    use DispatchesJobs;

    /**
     * @param string $keyword
     * @param AbstractTaskStatus $taskStatus
     * @return mixed
     */
    public function search(string $keyword, AbstractTaskStatus $taskStatus)
    {
        return $this->dispatch(new GetTasksByKeyword($keyword, $taskStatus));
    }
}
