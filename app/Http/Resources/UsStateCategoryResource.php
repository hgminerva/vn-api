<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsStateCategoryResource extends JsonResource
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
            'category' => $this->category,
            'description' => $this->description,
            'question' => $this->question
        ];
    }
}
