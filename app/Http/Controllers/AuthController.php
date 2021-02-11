<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Get authenticated user information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * Update authenticated user information.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->only('name', 'email');

        $request->user()->update($data);

        return new UserResource($request->user());
    }
}
