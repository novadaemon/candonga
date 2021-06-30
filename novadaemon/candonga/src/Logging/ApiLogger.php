<?php

namespace Candonga\Logging;

use Monolog\Logger;

class ApiLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger =  new Logger('api');
        $logger->pushHandler(new DatabaseHandler('api_log'));

        return $logger;
    }
}