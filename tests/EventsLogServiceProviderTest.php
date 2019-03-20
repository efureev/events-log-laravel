<?php

namespace AvtoDev\EventsLogLaravel\Tests;

use AvtoDev\EventsLogLaravel\Contracts\EventsSubscriberContract;
use AvtoDev\EventsLogLaravel\Listeners\EventsSubscriber;

/**
 * Class EventsLogServiceProviderTest
 * @package AvtoDev\EventsLogLaravel\Tests
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
