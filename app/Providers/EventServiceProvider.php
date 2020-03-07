<?php

namespace App\Providers;

use App\Events\NewStoryHasAppeared;
use App\Listeners\CreateRecordForHistory;
use App\Listeners\SendToTelegramBotTask;
use Domain\Task\Events\TaskCreated;
use App\Listeners\CreateTimerForTask;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TaskCreated::class => [
            CreateTimerForTask::class,
            SendToTelegramBotTask::class
        ],
        NewStoryHasAppeared::class => [
            CreateRecordForHistory::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
