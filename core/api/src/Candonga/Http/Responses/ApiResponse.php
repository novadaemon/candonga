<?php namespace Candonga\Http\Responses;

use Illuminate\Support\Facades\Log;

abstract class  ApiResponse
{
    /**
     * @param $success [true|false]
     * @param array $data
     * @param string $message
     * @param int $status
     * @param array $additional
     * @return \Illuminate\Http\JsonResponse
     */
    public static function response($success, $data = [], $message = '', $status = 200, $additional = [])
    {
        $response = [
            'success' => $success,
            'data'    => $data,
            'message' => $message,
        ];

        if($additional)
            $response = array_merge($response, $additional);

        if(config('candonga.api.logging.store'))

            /**
             * Log only if Token is sent
             * and store log is set true
             */
            if(request()->user() && config('candonga.api.logging.store')){
                Log::channel(config('candonga.api.logging.use_channel'))->info($message, [
                    'user' => request()->user()  ? request()->user()->email : '',
                    'endpoint' => request()->getUri(),
                    'request' => [
                        'parameters' => request()->all()
                    ],
                    'response' => [
                        'status' => $status,
                        'content'  => $response
                    ]
                ]);
            }

        return response()->json($response, $status);
    }
}