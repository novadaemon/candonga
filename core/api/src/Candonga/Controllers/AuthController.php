<?php namespace Candonga\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends BaseController
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $params = $this->request->all();

        $validator = \Validator::make($params, [
            'email'     => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return $this->response(
            false,
            [],
            [
                'errors' => $validator->errors()
            ],
            422
        );

        $credentials = [
            'email'    => $params['email'],
            'password' => $params['password'],
        ];

        if ($this->guard->attempt($credentials))
        {
            $user = $this->guard->user();

            $user->forceFill([
                'api_token' => Str::random(80)
            ])->save();

            return $this->response(true, [
                'Token' => $user->api_token
            ],
                ''
                , 200
            );
        }

        return $this->response(false, [], 'Email or password invalid', 401);
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

        return $this->response(true, [], 'The user has logout.', 200);
    }
}

