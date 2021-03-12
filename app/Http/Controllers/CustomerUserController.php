<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerUserRequest;
use App\Http\Resources\CustomerUserResource;

use App\Mail\SendNotificationToUser;

use App\Models\CustomerUser;
use App\Models\VaccineUrl;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo;

class CustomerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $customer_users = CustomerUser::with('customer','user','us_state','us_state_category','office_us_state','office_us_state_category')->paginate();

        return CustomerUserResource::collection($customer_users);
    }

    /**
     * Display a listing of the resource.
     *
    * @return AnonymousResourceCollection
     */
    public function customerUsersByCustomer(CustomerUserRequest $request): AnonymousResourceCollection
    {
        $customer_users = CustomerUser::with('customer','user','us_state','us_state_category','office_us_state','office_us_state_category')
                                ->where('customer_id', $request->customer_id)
                                ->paginate();

        return CustomerUserResource::collection($customer_users);
    }

    /**
     * Send email to user
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function sendEmailToUser($id, $batch_number): JsonResponse
    {
        $customer_user = CustomerUser::findOrFail($id);

        Mail::to($customer_user->email)->send(new SendNotificationToUser($customer_user, $batch_number));

        return response()->json(['status' => 'Mail successfully sent'], Response::HTTP_OK);
    }

    /**
     * Send sms to user
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function sendSmsToUser($id): JsonResponse
    {
        $customer_user = CustomerUser::findOrFail($id);
        $cellphone = "1" . $customer_user->cellphone;

        Nexmo::message()->send([
            // 'to'   => '639178123982',
            'to'   => $cellphone,
            'from' => '12013553975',
            'text' => 'Vaccine Tracker: Match Found.  To view result go to https://tinyurl.com/3ht5a8s9'
        ]);

        return response()->json(['status' => 'SMS successfully sent'], Response::HTTP_OK);
    }

    /**
     * Notify the user initially
     *
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function notifyUser($id): JsonResponse {
        $vaccine_urls = VaccineUrl::with('us_state')->orderBy('id', 'DESC')->get();
        $customer_user = CustomerUser::findOrFail($id);

        if($customer_user) {
            foreach($vaccine_urls as $vaccine_url) {

                # Get the zipcode distance
                $distance_flag = false;
                $zipcodes = explode(',', $customer_user->zipcodes);
                foreach($zipcodes as $zipcode) {
                    if(count($zipcodes) > 0) {
                        foreach($zipcodes as $z) {
                            if($z) {
                                $code = explode('|', $z);
                                echo $code[1];
                            }
                        }
                    }
                    echo "\n\r";
                }
            }
        }
        return response()->json(['status' => 'Notification complete'], Response::HTTP_OK);
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
        $customer_user = CustomerUser::with('customer','user','us_state','us_state_category')
                                    ->findOrFail($id);

        return new CustomerUserResource($customer_user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $
     *
     * @return CustomerUserResource
     */
    public function showUserByUserNumber($user_number): CustomerUserResource
    {
        $customer_user = CustomerUser::with('customer','user','us_state','us_state_category')
                                     ->where('user_number', $user_number)->firstOrFail();

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
