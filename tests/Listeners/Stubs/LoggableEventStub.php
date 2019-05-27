<?php

namespace Feugene\EventsLogLaravel\Tests\Listeners\Stubs;

use Feugene\EventsLogLaravel\Contracts\ShouldBeLoggedContract;

class LoggableEventStub implements ShouldBeLoggedContract
{
    /**
     * {@inheritDoc}
     */
    public function logLevel(): string
    {
        return 'debug';
    }

    /**
     * {@inheritDoc}
     */
    public function logMessage(): string
    {
        return 'log message';
    }

    /**
     * {@inheritDoc}
     */
    public function logEventExtraData(): array
    {
        return ['foo' => 'bar'];
    }

    /**
     * {@inheritDoc}
     */
    public function eventType(): string
    {
        return 'event type';
    }

    /**
     * {@inheritDoc}
     */
    public function eventSource(): string
    {
        return 'event source';
    }

    /**
     * {@inheritDoc}
     */
    public function eventTags(): array
    {
        return ['tag1', 'tag2'];
    }
}
