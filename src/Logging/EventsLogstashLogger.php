<?php

declare(strict_types=1);

namespace Feugene\EventsLogLaravel\Logging;

use Feugene\EventsLogLaravel\Contracts\LoggerContract;
use Feugene\EventsLogLaravel\Logging\Formatters\EventsLogstashFormatter;
use Exception;
use Monolog\Formatter\LogstashFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class EventsLogstashLogger
 * @package Feugene\EventsLogLaravel\Logging
 */
class EventsLogstashLogger implements LoggerContract
{
    /**
     * {@inheritDoc}
     *
     * @throws Exception
     */
    public function __invoke(array $config): Logger
    {
        $formatter = new EventsLogstashFormatter(
            $config['formatter']['app_name'] ?? resolve('config')->get('app.name'),
            $config['formatter']['system_name'] ?? null,
            $config['formatter']['extra_prefix'] ?? false,
            $config['formatter']['context_prefix'] ?? null,
            $config['formatter']['version'] ?? LogstashFormatter::V1
        );

        $handler = new StreamHandler(
            $config['path'] ?? storage_path('logs/logstash/laravel-events.log'),
            $config['level'] ?? 'debug',
            $config['bubble'] ?? true,
            $config['permission'] ?? null,
            $config['locking'] ?? false
        );

        $name = $config['name'] ?? app()->environment();

        return (new Logger($name))->pushHandler($handler->setFormatter($formatter));
    }
}
