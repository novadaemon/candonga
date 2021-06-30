  <?php

  return [
     /*
     |--------------------------------------------------------------------------
     | Api Log Channels
     |--------------------------------------------------------------------------
     |
     | Select channels to logged API requests and responses.
     |
     */
     'api' => [
         'driver' => 'stack',
         'channels' => ['file', 'database'], //Select drivers to store logs
         'ignore_exceptions' => false,
     ],
     'file' => [
        'driver' => 'single',
        'path' => storage_path('logs/api.log'),
        'level' => 'info',
     ],
     'database' => [
        'driver' => 'custom',
        'via' => Candonga\Logging\ApiLogger::class
     ]
  ];