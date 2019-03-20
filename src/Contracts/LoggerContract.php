<?php

namespace AvtoDev\EventsLogLaravel\Contracts;

use Monolog\Logger;

/**
 * Interface LoggerContract
 * @package AvtoDev\EventsLogLaravel\Contracts
 */
interface LoggerContract
{
    /**
     * Create a Monolog instance.
     *
     * @param array $config
     *
     * @return Logger
     */
    public function __invoke(array $config): Logger;
}
