<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Models\Message;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{
    // display list
    public function index(): AnonymousResourceCollection
    {
        $messages = Message::all();
        return MessageResource::collection($messages);
    }
    // save
    public function store(Request $request): MessageResource
    {
        $message = Message::create($request->all());

        return new MessageResource($message);
    }
    // display
    public function show($id): MessageResource
    {
        $message = Message::findOrFail($id);

        return new MessageResource($message);
    }
    // update
    public function update(Request $request, $id): MessageResource
    {
        $message = Message::findOrFail($id);
        $message->update($request->all());

        return new MessageResource($message->refresh());
    }
    // delete
    public function destroy($id): Response
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return response()->noContent();
    }
}
