<?php

namespace AvtoDev\EventsLogLaravel\Tests\Events;

use AvtoDev\EventsLogLaravel\Contracts\ShouldBeLoggedContract;
use AvtoDev\EventsLogLaravel\Events\AbstractLoggableEvent;
use AvtoDev\EventsLogLaravel\Tests\AbstractTestCase;

/**
 * Class EventsTest
 * @package AvtoDev\EventsLogLaravel\Tests\Events
 */
class EventsTest extends AbstractTestCase
{
    /**
     * Test events.
     *
     * @return void
     */
    public function testEvents(): void
    {
        $instance = new class extends AbstractLoggableEvent
        {
            /**
             * {@inheritdoc}
             */
            public function logMessage(): string
            {
                return 'foo';
            }
        };

        static::assertInstanceOf(ShouldBeLoggedContract::class, $instance);

        static::assertStringsEquals('info', $instance->logLevel(), false);
        static::assertEmptyArray($instance->logEventExtraData());
        static::assertStringsEquals('UNKNOWN', $instance->eventType(), false);
        static::assertStringsEquals('UNKNOWN', $instance->eventSource(), false);
    }
}
