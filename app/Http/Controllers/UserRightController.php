<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRightRequest;
use App\Http\Resources\UserRightResource;

use App\Models\UserRight;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserRightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $user_rights = UserRight::with('user')->get();

        return UserRightResource::collection($user_rights);
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function userRightsByUser(UserRightRequest $request): AnonymousResourceCollection
    {
        $user_rights = UserRight::with('user')
                                ->where('user_id', $request->user_id)
                                ->get();

        return UserRightResource::collection($user_rights);
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function userRightsByUsername(UserRightRequest $request): AnonymousResourceCollection
    {
        $user = User::where('username', $request->username)
                    ->first();
               
        $user_id = 0;
        if($user) {
            $user_id = $user->id;
        }

        $user_rights = UserRight::with('user')
                                ->where('user_id', $user_id)
                                ->get();

        return UserRightResource::collection($user_rights);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return UserRightResource
     */
    public function store(UserRightRequest $request): UserRightResource
    {
        $user_right = UserRight::create($request->all());

        return new UserRightResource($user_right);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return UserRightResource
     */
    public function show($id): UserRightResource
    {
        $user_right = UserRight::findOrFail($id);

        return new UserRightResource($user_right);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return UserRightResource
     */
    public function update(UserRightRequest $request, $id): UserRightResource
    {
        $user_right = UserRight::findOrFail($id);

        $user_right->update($request->all());

        return new UserRightResource($user_right->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id): Response
    {
        $user_right = UserRight::findOrFail($id);

        $user_right->delete();

        return response()->noContent();
    }
}
