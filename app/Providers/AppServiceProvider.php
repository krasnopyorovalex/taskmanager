<?php

namespace App\Providers;

use App\Domain\Comment\DataMaps\DataMapForComment;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Domain\Comment\DataMaps\DataMap;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        setlocale(LC_TIME, 'ru_RU.UTF-8');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(DataMap::class, static function () {
            return new DataMapForComment();
        });

        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
