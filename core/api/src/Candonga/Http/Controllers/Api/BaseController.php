<?php namespace Candonga\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

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
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;

        $this->middleware(['auth:api'])
            ->except('login');
    }
}

