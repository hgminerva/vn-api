<?php

namespace App\Http\Controllers;

use App\Http\Requests\DependentRequest;
use App\Http\Resources\DependentResource;

use App\Mail\SendNotificationToUser;

use App\Models\Dependent;
use App\Models\VaccineUrl;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo;

class DependentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $dependents = Dependent::with('customer_user','customer_user_dependent')->paginate();

        return DependentResource::collection($dependents);
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function dependentsByUser(DependentRequest $request): AnonymousResourceCollection
    {
        $dependents = Dependent::with('customer_user','customer_user_dependent')
                                ->where('customer_user_id', $request->customer_user_id)
                                ->get();

        return DependentResource::collection($dependents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return DependentResource
     */
    public function store(DependentRequest $request): DependentResource
    {
        $dependent = Dependent::create($request->all());

        return new DependentResource($dependent);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return DependentResource
     */
    public function show($id): DependentResource
    {
        $dependent = Dependent::with('customer_user','customer_user_dependent')
                                    ->findOrFail($id);

        return new DependentResource($dependent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return DependentResource
     */
    public function update(DependentRequest $request, $id): DependentResource
    {
        $dependent = Dependent::findOrFail($id);

        $dependent->update($request->all());

        return new DependentResource($dependent->refresh());
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
        $dependent = Dependent::findOrFail($id);

        $dependent->delete();

        return response()->noContent();
    }
}
