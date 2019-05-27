<?php

declare(strict_types=1);

namespace Feugene\EventsLogLaravel;

use Feugene\EventsLogLaravel\Contracts\EventsSubscriberContract;
use Feugene\EventsLogLaravel\Listeners\EventsSubscriber;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Log\LogManager;
use Illuminate\Support\ServiceProvider;

/**
 * Class EventsLogServiceProvider
 * @package Feugene\EventsLogLaravel
 */
class EventsLogServiceProvider extends ServiceProvider
{
    /**
     * Register events logger.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerChannel();

        $this->registerSubscriber();
    }

    /**
     * Bootstrap events subscriber.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot(): void
    {
        $this->app->make('events')->subscribe($this->app->make(EventsSubscriberContract::class));
    }

    /**
     * Register events logging channel name.
     *
     * @return void
     */
    protected function registerChannel(): void
    {
        $this->app->bind('log.events.channel', function (Application $app) {
            return $app->make('config')->get('logging.events_channel', env('EVENTS_LOG_CHANNEL', 'default'));
        });
    }

    /**
     * Register event subscriber.
     *
     * @return void
     */
    protected function registerSubscriber(): void
    {
        $this->app->bind(EventsSubscriberContract::class, function (Application $app): EventsSubscriberContract {
            return new EventsSubscriber(
                $app->make(LogManager::class),
                $app->make('log.events.channel')
            );
        });
    }
}
