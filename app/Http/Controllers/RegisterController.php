<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Login guest user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $data = $request->only('name', 'email', 'username', 'password', 'user_type');

        $user = User::create($data);

        $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;

        return (new UserResource($user))->additional(compact('token'));
    }
}
