<?php

declare(strict_types=1);

namespace App\Domain\Timer\Queries;

use App\Timer;

/**
 * Class TimerStartQuery
 * @package App\Domain\Timer\Queries
 */
class TimerStartQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * TimerStartQuery constructor.
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

        $timer->job_start = time();

        return $timer->save();
    }
}
