<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $orders = Order::all();

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return OrderResource
     */
    public function store(OrderRequest $request): OrderResource
    {
        $order = Order::create($request->all());

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return OrderResource
     */
    public function show($id): OrderResource
    {
        $order = Order::findOrFail($id);

        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return OrderResource
     */
    public function update(OrderRequest $request, $id): OrderResource
    {
        $order = Order::findOrFail($id);

        $order->update($request->all());

        return new OrderResource($order->refresh());
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
        $order = Order::findOrFail($id);

        $order->delete();

        return response()->noContent();
    }
}
