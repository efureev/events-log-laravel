<?php

declare(strict_types=1);

namespace Feugene\EventsLogLaravel\Logging\Formatters;

/**
 * Class DefaultLogstashFormatter
 * @package Feugene\EventsLogLaravel\Logging\Formatters
 */
class DefaultLogstashFormatter extends AbstractLogstashFormatter
{
    /**
     * {@inheritDoc}
     */
    protected function modifyParentMessage(array $parent_message, array $record): array
    {
        $parent_message['entry_type'] = 'log';

        return $parent_message;
    }
}
