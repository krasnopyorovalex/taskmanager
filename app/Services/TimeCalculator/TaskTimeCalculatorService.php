<?php

declare(strict_types=1);

namespace App\Services\TimeCalculator;

use App\Task;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TaskTimeCalculatorService
 * @package App\Services\TimeCalculator
 */
class TaskTimeCalculatorService extends AbstractTimeCalculatorService
{
    private const COST_PER_MINUTE = 12.5;

    public function total(Collection $collection): int
    {
        return $collection->sum(static function (Task $task) {
            return $task->timer->total;
        });
    }

    public function cost(Collection $collection): float
    {
        return $this->total($collection) / 60;
    }
}
