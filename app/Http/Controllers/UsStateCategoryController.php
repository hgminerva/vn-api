<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsStateCategoryRequest;
use App\Http\Resources\UsStateCategoryResource;
use App\Models\UsStateCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UsStateCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $us_state_categories = UsStateCategory::all()->with('us_state')->paginate();

        return UsStateCategoryResource::collection($us_state_categories);
                           
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function categoriesByUSState(UsStateCategoryRequest $request): AnonymousResourceCollection
    {
        $us_state_categories = UsStateCategory::with('us_state')
                                ->where('us_state_id', $request->us_state_id)
                                ->get();

        return UsStateCategoryResource::collection($us_state_categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return UsStateCategoryResource
     */
    public function store(UsStateCategoryRequest $request): UsStateCategoryResource
    {
        $us_state_category = UsStateCategory::create($request->all());

        return new UsStateCategoryResource($us_state_category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return UsStateCategoryResource
     */
    public function show($id): UsStateCategoryResource
    {
        $us_state_category = UsStateCategory::findOrFail($id);

        return new UsStateCategoryResource($us_state_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return UsStateCategoryResource
     */
    public function update(UsStateCategoryRequest $request, $id): UsStateCategoryResource
    {
        $us_state_category = UsStateCategory::findOrFail($id);

        $us_state_category->update($request->all());

        return new UsStateCategoryResource($us_state_category->refresh());
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
        $us_state_category = UsStateCategory::findOrFail($id);

        $us_state_category->delete();

        return response()->noContent();
    }
}
