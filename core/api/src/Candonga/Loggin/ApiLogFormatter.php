<?php namespace Candonga\Logging;

use Carbon\Carbon;
use Monolog\Formatter\NormalizerFormatter;

class ApiLogFormatter extends NormalizerFormatter
{
    /**
     * type
     */

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * {@inheritdoc}
     */
    public function format(array $record)
    {
        $record = parent::format($record);
        return $this->getDocument($record);
    }
    /**
     * @param array $record
     * @return array
     */
    protected function getDocument(array $record)
    {
        $data = [
            'insert_at' => new Carbon($record['datetime']),
            'level'     => strtolower($record['level_name']),
            'endpoint'  => $record['context']['endpoint'],
            'user'      => $record['context']['user'],
            'message'   => $record['message'],
            'request'   => json_encode($record['context']['request']),
            'response'  => json_encode($record['context']['response']),
        ];
        return $data;
    }
}