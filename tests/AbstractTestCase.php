<?php

namespace Feugene\EventsLogLaravel\Tests;

use AvtoDev\DevTools\Tests\PHPUnit\AbstractLaravelTestCase;
use Feugene\EventsLogLaravel\EventsLogServiceProvider;
use Feugene\EventsLogLaravel\Tests\Bootstrap\TestsBootstrapper;
use Illuminate\Foundation\Application;

/**
 * Class AbstractTestCase
 * @package Feugene\EventsLogLaravel\Tests
 */
class AbstractTestCase extends AbstractLaravelTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function beforeApplicationBootstrapped(Application $app): void
    {
        $app->useStoragePath(TestsBootstrapper::getStorageDirectoryPath());
    }

    /**
     * {@inheritdoc}
     */
    protected function afterApplicationBootstrapped(Application $app): void
    {
        putenv('EVENTS_LOG_CHANNEL=default');

        $app->register(EventsLogServiceProvider::class);
    }
}
