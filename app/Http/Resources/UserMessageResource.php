<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'sender_user_id' => $this->sender_user_id,
            'sender_user' => new UserResource($this->whenLoaded('sender_user')),
            'message' => $this->message,
            'message_timestamp' => $this->message_timestamp,
        ];
    }
}
