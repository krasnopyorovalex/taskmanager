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
    private const COST_PER_MINUTE = 15.84;

    public function total(Collection $tasks): int
    {
        return $tasks->sum(static function (Task $task) {
            return $task->timer->total;
        });
    }

    public function cost(Collection $tasks): float
    {
        $minutes = (int) round($this->total($tasks) / 60);

        return $minutes * self::COST_PER_MINUTE;
    }
}
