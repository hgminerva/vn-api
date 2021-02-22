<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VaccineUrlResource extends JsonResource
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
            'url_address' => $this->url_address,
            'current_content' => $this->current_content,
            'previous_content' => $this->previous_content,
            'zipcodes' => $this->zipcodes,
            'remarks' => $this->remarks,
            'description' => $this->description,
            'state_initial' => $this->state_initial,
            'category' => $this->category,
            'enabled' => $this->enabled
        ];
    }
}
