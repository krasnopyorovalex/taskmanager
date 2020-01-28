<?php

declare(strict_types=1);

namespace Domain\Timer\Commands;

use App\Timer;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class StopCommand
 * @package Domain\Timer\Commands
 */
class StopCommand
{
    use DispatchesJobs;

    /**
     * @var Timer
     */
    private $timer;

    /**
     * StopCommand constructor.
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
        $total = $this->calculateTotal();

        return $this->timer->update([
            'total' => $total
        ]);
    }

    /**
     * @return int
     */
    private function calculateTotal(): int
    {
        return $this->timer->total + (time() - $this->timer->job_start);
    }
}
