<?php

declare(strict_types=1);

namespace Feugene\EventsLogLaravel\Contracts;

/**
 * Interface ShouldBeLoggedContract
 * @package Feugene\EventsLogLaravel\Contracts
 */
interface ShouldBeLoggedContract
{
    /**
     * Log level. Can be one of: 'emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'.
     *
     * @return string
     */
    public function logLevel(): string;

    /**
     * Log message.
     *
     * @return string
     */
    public function logMessage(): string;

    /**
     * Log event extra data.
     *
     * @return array
     */
    public function logEventExtraData(): array;

    /**
     * Event type (some type identifier).
     *
     * @return string
     */
    public function eventType(): string;

    /**
     * Event source (initiator of an event, service name).
     *
     * @return string
     */
    public function eventSource(): string;

    /**
     * Events tags
     * @return array
     */
    public function eventTags(): array;

    /*
     * Determine if this event should be skipped.
     *
     * Is not required for implementation.
     *
     * @see \Feugene\EventsLogLaravel\Listeners\EventsSubscriber::skipLoggingConditions()
     *
     * @return bool
     */
    //public function skipLogging(): bool;
}
