<?php

return [
    'api' => [
        'logging' => [
           /*
            * Set if store API logs.
            */
            'store' => env('LOG_API', true),
            /*
             * Select channel to store logs
             */
            'use_channel' => 'api'
        ]
    ]
];