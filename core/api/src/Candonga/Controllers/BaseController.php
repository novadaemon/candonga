<?php namespace Candonga\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $guard;

    /**
     * @var \Illuminate\Http\Request;
     */
    protected $request;


    /**
     * APIController constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard, Request $request)
    {
        $this->guard = $guard;
        $this->request = $request;

        $this->middleware(['auth:api'])
            ->except('login');
    }

    /**
     * @param $success
     * @param array $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function response($success, $data = [], $message = '', $status = 200)
    {
        $response = [
            'success' => $success,
            'data'    => $data,
            'message' => $message,
        ];

        return response()->json($response, $status);
    }
}

