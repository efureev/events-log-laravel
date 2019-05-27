<?php

namespace Feugene\EventsLogLaravel\Tests\Logging\Formatters;

use Monolog\Formatter\LogstashFormatter;
use Feugene\EventsLogLaravel\Tests\AbstractTestCase;
use Feugene\EventsLogLaravel\Logging\Formatters\AbstractLogstashFormatter;

/**
 * @group logging
 */
abstract class AbstractLogstashFormatterTestCase extends AbstractTestCase
{
    /**
     * Базовый тест модификатора данных от родительского класса.
     */
    public function testModifyParentMessage(): void
    {
        foreach ([LogstashFormatter::V0, LogstashFormatter::V1] as $version) {
            $instance = new class($app_name = 'test_app', $system_nme = null, $extra_prefix = null, $context_prefix = 'ctxt_', $version) extends AbstractLogstashFormatter {
                /**
                 * {@inheritdoc}
                 */
                protected function modifyParentMessage(array $parent_message, array $record): array
                {
                    $parent_message['foo'] = 'bar';

                    return $parent_message;
                }
            };

            $formatted = \json_decode($instance->format([
                'some' => 'shit',
            ]), true);

            $this->assertEquals('bar', $formatted['foo']);
        }
    }
}
