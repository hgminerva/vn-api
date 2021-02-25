<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsStateRequest;
use App\Http\Resources\UsStateResource;
use App\Models\UsState;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UsStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $us_states = UsState::orderBy('state_name')->paginate();

        return UsStateResource::collection($us_states);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function listAllUSStates(): AnonymousResourceCollection
    {
        $us_states = UsState::all()->orderBy('state_name');

        return UsStateResource::collection($us_states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return UsStateResource
     */
    public function store(UsStateRequest $request): UsStateResource
    {
        $us_state = UsState::create($request->all());

        return new UsStateResource($us_state);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return UsStateResource
     */
    public function show($id): UsStateResource
    {
        $us_state = UsState::findOrFail($id);

        return new UsStateResource($us_state);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return UsStateResource
     */
    public function update(UsStateRequest $request, $id): UsStateResource
    {
        $us_state = UsState::findOrFail($id);

        $us_state->update($request->all());

        return new UsStateResource($us_state->refresh());
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
        $us_state = UsState::findOrFail($id);

        $us_state->delete();

        return response()->noContent();
    }
}
