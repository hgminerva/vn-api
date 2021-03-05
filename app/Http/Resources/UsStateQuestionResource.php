<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsStateQuestionResource extends JsonResource
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
            'us_state_id' => $this->us_state_id,
            'us_state' => new UsStateResource($this->whenLoaded('us_state')),
            'question' => $this->question,
            'question_value' => $this->question_value
        ];
    }
}
