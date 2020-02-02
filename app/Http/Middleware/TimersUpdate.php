<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Domain\Task\Commands\UpdateTimersCommand;
use Domain\Task\Queries\GetTasksByGroupsQuery;
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
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tasks = $this->dispatch(new GetTasksByGroupsQuery(false, 'IN_WORK'));

        $this->dispatch(new UpdateTimersCommand($tasks));

        return $next($request);
    }
}
