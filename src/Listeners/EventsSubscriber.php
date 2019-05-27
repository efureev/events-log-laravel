<?php

declare(strict_types=1);

namespace Feugene\EventsLogLaravel\Listeners;

use Feugene\EventsLogLaravel\Contracts\EventsSubscriberContract;
use Feugene\EventsLogLaravel\Contracts\ShouldBeLoggedContract;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Log\LogManager;
use Psr\Log\LoggerInterface;

/**
 * Class EventsSubscriber
 * @package Feugene\EventsLogLaravel\Listeners
 */
class EventsSubscriber implements EventsSubscriberContract
{
    /**
     * @var LoggerInterface
     */
    protected $log_driver;

    /**
     * Logger channel name, declared in `./config/logging.php['events_channel']`.
     *
     * @var string|null
     */
    protected $logger_channel_name;

    /**
     * EventsLoggerSubscriber constructor.
     *
     * @param LogManager $log_manager
     * @param string|null $logger_channel_name
     */
    public function __construct(LogManager $log_manager, ?string $logger_channel_name = null)
    {
        $this->logger_channel_name = $logger_channel_name;
        $this->log_driver = $log_manager->driver($this->logger_channel_name);
    }

    /**
     * Returns logger.
     *
     * @return LoggerInterface
     */
    public function logDriver(): LoggerInterface
    {
        return $this->log_driver;
    }

    /**
     * All events listener.
     *
     * @param mixed|string $event
     * @param array $event_data
     *
     * @return void
     */
    public function onAnyEvents($event, array $event_data): void
    {
        $event_name = \is_string($event)
            ? $event
            : null;

        foreach ($event_data as $event_datum) {
            if ($event_datum instanceof ShouldBeLoggedContract
                && !$this->skipEventLogging($event_datum)
            ) {
                $this->writeEventIntoLog($event_datum, $event_name);
            }
        }
    }

    /**
     * Write event into log file.
     *
     * @param ShouldBeLoggedContract $event
     * @param string|null $event_name
     *
     * @return void
     */
    public function writeEventIntoLog(ShouldBeLoggedContract $event, $event_name = null): void
    {
        $this->log_driver->log($event->logLevel(), $event->logMessage(), [
            'event' => \array_replace_recursive([
                'source' => $event->eventSource(),
                'tags' => $event->eventTags(),
                'type' => $event->eventType(),
                'name' => $event_name,
            ], $event->logEventExtraData()),
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function subscribe(Dispatcher $events): void
    {
        $events->listen('*', [$this, 'onAnyEvents']);
    }

    /**
     * Make event additional checks using conditions.
     *
     * @param ShouldBeLoggedContract $event
     *
     * @return bool
     */
    protected function skipEventLogging(ShouldBeLoggedContract $event): bool
    {
        return \method_exists($event, $method_name = 'skipLogging') && $event->{$method_name}() === true;
    }
}
