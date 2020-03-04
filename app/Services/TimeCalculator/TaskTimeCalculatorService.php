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
    public function total(Collection $tasks): int
    {
        return $tasks->sum(static function (Task $task) {
            return $task->timer->total;
        });
    }
}
