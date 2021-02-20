<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Http\Resources\NotificationResource;
use App\Mail\SendNotificationToUser;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $notifications = Notification::with('customer_user','vaccine_url')->paginate();

        return NotificationResource::collection($notifications);
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function notificationsByCustomerUser(NotificationRequest $request): AnonymousResourceCollection
    {
        $notifications = Notification::with('customer_user','vaccine_url')
                                     ->where('customer_user_id', $request->customer_user_id);

        return NotificationResource::collection($notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return NotificationResource
     */
    public function store(NotificationRequest $request): NotificationResource
    {
        $notification = Notification::create($request->all());

        return new NotificationResource($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return NotificationResource
     */
    public function show($id): NotificationResource
    {
        $notification = Notification::with('customer_user','vaccine_url')
                                    ->findOrFail($id);

        return new NotificationResource($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $
     *
     * @return NotificationResource
     */
    public function showNotificationByBatchNumber($batch_number): NotificationResource
    {
        $notification = Notification::with('customer_user','vaccine_url')
                                     ->where('batch_number', $batch_number)->firstOrFail();

        return new NotificationResource($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return NotificationResource
     */
    public function update(NotificationRequest $request, $id): NotificationResource
    {
        $notification = Notification::findOrFail($id);

        $notification->update($request->all());

        return new NotificationResource($notification->refresh());
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
        $notification = Notification::findOrFail($id);

        $notification->delete();

        return response()->noContent();
    }
}
