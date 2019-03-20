<?php

namespace AvtoDev\EventsLogLaravel\Tests\Logging;

use AvtoDev\EventsLogLaravel\Logging\EventsLogstashLogger;
use AvtoDev\EventsLogLaravel\Logging\Formatters\EventsLogstashFormatter;
use AvtoDev\EventsLogLaravel\Tests\AbstractTestCase;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class EventsLogstashLoggerTest
 * @package AvtoDev\EventsLogLaravel\Tests\Logging
 * @group logging
 */
class EventsLogstashLoggerTest extends AbstractTestCase
{
    /**
     * Test factory with default parameters.
     *
     * @todo: Write test with custom parameters
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \ReflectionException
     */
    public function testInstanceCreator(): void
    {
        $config = [
            'formatter' => [
                'app_name' => null,
                'system_name' => null,
                'extra_prefix' => null,
                'context_prefix' => null,
                'version' => null,
            ],
            'path' => $path = storage_path('logs/laravel-events.logstash.log'),
            'level' => null,
            'bubble' => null,
            'permission' => null,
            'locking' => null,
        ];

        /** @var Logger $instance */
        $instance = (new EventsLogstashLogger)($config);
        static::assertInstanceOf(Logger::class, $instance);

        /** @var HandlerInterface|StreamHandler $handler */
        $handler = $instance->getHandlers()[0];
        static::assertInstanceOf(StreamHandler::class, $handler);
        static::assertEquals($path, $handler->getUrl());
        static::assertEquals(Logger::DEBUG, $handler->getLevel());

        $formatter = $handler->getFormatter();
        static::assertInstanceOf(EventsLogstashFormatter::class, $formatter);
        static::assertEquals(\gethostname(), static::getProperty($formatter, 'systemName'));
        static::assertEquals(
            $this->app->make('config')->get('app.name'),
            static::getProperty($formatter, 'applicationName')
        );
    }
}
