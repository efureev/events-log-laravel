<?php

declare(strict_types=1);

namespace Feugene\EventsLogLaravel\Events;

use Feugene\EventsLogLaravel\Contracts\ShouldBeLoggedContract;

/**
 * Class AbstractLoggableEvent
 * @package Feugene\EventsLogLaravel\Events
 */
abstract class AbstractLoggableEvent implements ShouldBeLoggedContract
{
    /**
     * {@inheritDoc}
     */
    public function logLevel(): string
    {
        return 'info';
    }

    /**
     * {@inheritDoc}
     */
    public function logEventExtraData(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function eventType(): string
    {
        return 'UNKNOWN';
    }

    /**
     * {@inheritDoc}
     */
    public function eventSource(): string
    {
        return 'UNKNOWN';
    }

    /**
     * {@inheritDoc}
     */
    public function eventTags(): array
    {
        return [];
    }
}
