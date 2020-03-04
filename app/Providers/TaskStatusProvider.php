<?php

declare(strict_types=1);

namespace App\Providers;

use Domain\Task\Entities\AbstractTaskStatus;
use Domain\Task\Entities\Implementation\TaskStatus;
use Illuminate\Support\ServiceProvider;

/**
 * Class TaskStatusProvider
 * @package App\Providers
 */
class TaskStatusProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(AbstractTaskStatus::class, static function () {
            return new TaskStatus();
        });
    }
}
