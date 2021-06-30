<?php namespace Candonga\Http\Controllers\Api;

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
}

