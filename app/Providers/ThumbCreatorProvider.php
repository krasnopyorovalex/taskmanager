<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ThumbCreator;
use Illuminate\Support\ServiceProvider;

/**
 * Class ThumbCreatorProvider
 * @package App\Providers
 */
class ThumbCreatorProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ThumbCreator::class, static function () {
            return new ThumbCreator();
        });
    }
}
