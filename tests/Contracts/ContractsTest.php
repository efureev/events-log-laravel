<?php

namespace AvtoDev\EventsLogLaravel\Tests\Contracts;

use AvtoDev\EventsLogLaravel\Contracts\EventsSubscriberContract;
use AvtoDev\EventsLogLaravel\Contracts\LoggerContract;
use AvtoDev\EventsLogLaravel\Contracts\ShouldBeLoggedContract;
use AvtoDev\EventsLogLaravel\Tests\AbstractTestCase;

/**
 * Class ContractsTest
 * @package AvtoDev\EventsLogLaravel\Tests\Contracts
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
