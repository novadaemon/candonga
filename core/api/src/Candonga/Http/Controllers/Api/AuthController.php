<?php namespace Candonga\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Candonga\Http\Responses\ApiResponse;

class AuthController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $params = $request->all();

        $validator = \Validator::make($params, [
            'email'     => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return ApiResponse::response(
            false,
            [],
            ['errors' => $validator->errors()],
            422
        );

        $credentials = [
            'email'    => $params['email'],
            'password' => $params['password'],
        ];

        if ($this->guard->validate($credentials))
        {
            $user = $this->guard->getProvider()
                ->retrieveByCredentials($credentials);

            $user->forceFill([
                'api_token' => Str::random(80)
            ])->save();

            return ApiResponse::response(true, ['Token' => $user->api_token], '');
        }

        return ApiResponse::response(false, [], 'Email or password invalid', 401);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->request->user()->forceFill([
            'api_token' => null
        ])->save();

        $this->guard->logout();

        return ApiResponse::response(true, [], 'The user has logout.');
    }
}

