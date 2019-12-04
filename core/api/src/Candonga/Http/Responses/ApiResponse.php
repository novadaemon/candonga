<?php namespace Candonga\Http\Responses;

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


        return response()->json($response, $status);
    }
}