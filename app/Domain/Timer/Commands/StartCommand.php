<?php

declare(strict_types=1);

namespace App\Domain\Timer\Commands;

use App\Timer;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class StartCommand
 * @package App\Domain\Timer\Commands
 */
class StartCommand
{
    use DispatchesJobs;

    /**
     * @var Timer
     */
    private $timer;

    /**
     * StartCommand constructor.
     * @param Timer $timer
     */
    public function __construct(Timer $timer)
    {
        $this->timer = $timer;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return $this->timer->update([
            'job_start' => time()
        ]);
    }
}
