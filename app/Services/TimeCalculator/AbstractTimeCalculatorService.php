<?php

declare(strict_types=1);

namespace App\Services\TimeCalculator;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class AbstractTimeCalculatorService
 * @package App\Services\TimeCalculator
 */
abstract class AbstractTimeCalculatorService
{
    abstract public function total(Collection $collection): int;
}
