<?php

declare(strict_types=1);

namespace AvtoDev\EventsLogLaravel\Events;

use AvtoDev\EventsLogLaravel\Contracts\ShouldBeLoggedContract;

/**
 * Class AbstractLoggableEvent
 * @package AvtoDev\EventsLogLaravel\Events
 */
abstract class AbstractLoggableEvent implements ShouldBeLoggedContract
{
    /**
     * {@inheritdoc}
     */
    public function logLevel(): string
    {
        return 'info';
    }

    /**
     * {@inheritdoc}
     */
    public function logEventExtraData(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function eventType(): string
    {
        return 'UNKNOWN';
    }

    /**
     * {@inheritdoc}
     */
    public function eventSource(): string
    {
        return 'UNKNOWN';
    }
}
