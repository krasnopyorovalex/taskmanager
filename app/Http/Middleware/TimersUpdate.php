<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Domain\Task\Commands\UpdateTimersCommand;
use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Queries\UpdateTasksTimersInWorkQuery;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class TimersUpdate
 * @package App\Http\Middleware
 */
class TimersUpdate
{
    use DispatchesJobs;

    /**
     * @var AbstractTaskStatus
     */
    private $taskStatus;

    public function __construct(AbstractTaskStatus $taskStatus)
    {
        $this->taskStatus = $taskStatus;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tasks = $this->dispatch(new UpdateTasksTimersInWorkQuery($this->taskStatus));

        $this->dispatch(new UpdateTimersCommand($tasks, $this->taskStatus));

        return $next($request);
    }
}
