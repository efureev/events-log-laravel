<?php

namespace Feugene\EventsLogLaravel\Contracts;

use Monolog\Logger;

/**
 * Interface LoggerContract
 * @package Feugene\EventsLogLaravel\Contracts
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
