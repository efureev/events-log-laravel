<?php

namespace Feugene\EventsLogLaravel\Tests;

use Feugene\EventsLogLaravel\Contracts\EventsSubscriberContract;
use Feugene\EventsLogLaravel\Listeners\EventsSubscriber;

/**
 * Class EventsLogServiceProviderTest
 * @package Feugene\EventsLogLaravel\Tests
 */
class EventsLogServiceProviderTest extends AbstractTestCase
{
    /**
     * Tests service-provider loading.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testServiceProviderLoading(): void
    {
        /* @see AbstractTestCase::afterApplicationBootstrapped */
        static::assertEquals('default', $this->app->make('log.events.channel'));

        static::assertInstanceOf(EventsSubscriber::class, $this->app->make(EventsSubscriberContract::class));
    }
}
