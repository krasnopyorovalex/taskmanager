<?php

declare(strict_types=1);

namespace Domain\Timer\Queries;

use App\Timer;

/**
 * Class TimerStopQuery
 * @package Domain\Timer\Queries
 */
class TimerStopQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * TimerStopQuery constructor.
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
        $timer = Timer::findOrFail($this->id);

        $timer->total += time() - $timer->job_start;

        return $timer->save();
    }
}
