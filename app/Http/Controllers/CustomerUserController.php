<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerUserRequest;
use App\Http\Resources\CustomerUserResource;
use App\Models\CustomerUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CustomerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $customer_users = CustomerUser::with('customer','user','us_state','us_state_category')->paginate();

        return CustomerUserResource::collection($customer_users);
                           
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function customerUsersByCustomer(CustomerUserRequest $request): AnonymousResourceCollection
    {
        $customer_users = CustomerUser::with('customer','user','us_state','us_state_category')
                                ->where('customer_id', $request->customer_id)
                                ->get()
                                ->paginate();

        return CustomerUserResource::collection($customer_users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return CustomerUserResource
     */
    public function store(CustomerUserRequest $request): CustomerUserResource
    {
        $customer_user = CustomerUser::create($request->all());

        return new CustomerUserResource($customer_user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return CustomerUserResource
     */
    public function show($id): CustomerUserResource
    {
        $customer_user = CustomerUser::findOrFail($id)->with('customer','user','us_state','us_state_category');

        return new CustomerUserResource($customer_user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return CustomerUserResource
     */
    public function update(CustomerUserRequest $request, $id): CustomerUserResource
    {
        $customer_user = CustomerUser::findOrFail($id);

        $customer_user->update($request->all());

        return new CustomerUserResource($customer_user->refresh());
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
        $customer_user = CustomerUser::findOrFail($id);

        $customer_user->delete();

        return response()->noContent();
    }
}
