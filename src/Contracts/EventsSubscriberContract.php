<?php

namespace Feugene\EventsLogLaravel\Contracts;

use Illuminate\Contracts\Events\Dispatcher;

/**
 * Interface EventsSubscriberContract
 * @package Feugene\EventsLogLaravel\Contracts
 */
interface EventsSubscriberContract
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param Dispatcher $events
     *
     * @return void
     */
    public function subscribe(Dispatcher $events): void;
}
