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

            'description' => $this->description,
            'url_address' => $this->url_address,
            'url_registration' => $this->url_registration,
            'site_message' => $this->site_message,
            'phase_served' => $this->phase_served,
            'last_updated' => $this->last_updated,
            'current_content' => $this->current_content,
            'previous_content' => $this->previous_content,
            'remarks' => $this->remarks,
            'can_scrape' => $this->can_scrape,
            
            'us_state_id' => $this->us_state_id,
            'us_state' => new UsStateResource($this->whenLoaded('us_state')),
            'state_initial' => $this->state_initial,
            'county' => $this->county,
            'zipcodes' => $this->zipcodes,
            
            'status' => $this->status,
            'category' => $this->category,
            'enabled' => $this->enabled
        ];
    }
}
