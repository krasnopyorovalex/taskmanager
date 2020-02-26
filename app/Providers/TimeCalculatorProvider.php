<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\TimeCalculator\TaskTimeCalculatorService;
use App\Services\TimeCalculator\AbstractTimeCalculatorService;
use Illuminate\Support\ServiceProvider;

/**
 * Class TimeCalculatorProvider
 * @package App\Providers
 */
class TimeCalculatorProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(AbstractTimeCalculatorService::class, static function () {
            return new TaskTimeCalculatorService;
        });
    }
}
