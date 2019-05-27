<?php

namespace Feugene\EventsLogLaravel\Tests\Contracts;

use Feugene\EventsLogLaravel\Contracts\EventsSubscriberContract;
use Feugene\EventsLogLaravel\Contracts\LoggerContract;
use Feugene\EventsLogLaravel\Contracts\ShouldBeLoggedContract;
use Feugene\EventsLogLaravel\Tests\AbstractTestCase;

/**
 * Class ContractsTest
 * @package Feugene\EventsLogLaravel\Tests\Contracts
 */
class ContractsTest extends AbstractTestCase
{
    /**
     * Tests contracts exists.
     *
     * @return void
     */
    public function testExists(): void
    {
        $classes = [
            EventsSubscriberContract::class,
            LoggerContract::class,
            ShouldBeLoggedContract::class,
        ];

        foreach ($classes as $class_name) {
            static::assertTrue(interface_exists($class_name));
        }
    }
}
