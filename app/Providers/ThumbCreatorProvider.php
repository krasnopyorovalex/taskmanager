<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\ImageNameChangerService;
use App\Services\ThumbCreatorService;
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
        $this->app->singleton(ThumbCreatorService::class, static function () {
            return new ThumbCreatorService(new ImageNameChangerService);
        });
    }
}
