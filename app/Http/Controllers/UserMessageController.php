<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserMessageRequest;
use App\Http\Resources\UserMessageResource;
use App\Models\UserMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserMessageController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
        $user_messages = UserMessage::with('user','sender_user')->get();

        return UserMessageResource::collection($user_messages);
    }

    // display list
    public function user_messages_by_user(UserMessageRequest $request): AnonymousResourceCollection
    {
        $user_messages = UserMessage::with('user','sender_user')
                                    ->where('user_id',$request->user_id)
                                    ->get();

        return UserMessageResource::collection($user_messages);
    }
  //  conversation
    public function conversation($user_id, $sender_user_id): AnonymousResourceCollection
    {
        $message = UserMessage::with('user','sender_user')
            ->where(['user_id' =>  $user_id,
            'sender_user_id' =>  $sender_user_id])
            ->orwhere([
            'user_id' =>  $sender_user_id,
            'sender_user_id' =>  $user_id])
            ->get();
        return UserMessageResource::collection($message);
    }
    // save
    public function store(UserMessageRequest $request): UserMessageResource
    {
        $user_messages = UserMessage::create($request->all());

        return new UserMessageResource($user_messages);
    }

    // display detail
    public function show($id): UserMessageResource
    {
        $user_message = UserMessage::findOrFail($id);

        return new UserMessageResource($user_message);
    }

    // update
    public function update(UserMessageRequest $request, $id): UserMessageResource
    {
        $user_message = UserMessage::findOrFail($id);
        $user_message->update($request->all());

        return new UserMessageResource($user_message->refresh());
    }

    // delete
    public function destroy($id): Response
    {
        $user_message = UserMessage::findOrFail($id);
        $user_message->delete();

        return response()->noContent();
    }
}
