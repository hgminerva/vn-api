<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): AnonymousResourceCollection
    {
        $users = User::all();

        return UserResource::collection($users);
    }
    // edit
    public function update(UserRequest $request, $id): UserResource
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->user_type = $request->user_type;
        $user->save();

        return new UserResource($user->refresh());
    }
}
