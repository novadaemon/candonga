<?php

namespace Candonga\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Candonga\Data\Entities\ApiLog;
use Monolog\Formatter\FormatterInterface;


class DatabaseHandler extends AbstractProcessingHandler
{
    protected $table;

    public function __construct($table, $level = Logger::INFO, $bubble = true)
    {
        $this->table =  $table;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        ApiLog::create($record['formatted']);
    }

    /**
     * Get a defaut Monolog formatter instance.
     *
     * @return \Monolog\Formatter\LineFormatter
     */
    protected function getDefaultFormatter(): FormatterInterface
    {
        return new ApiLogFormatter();
    }
}
