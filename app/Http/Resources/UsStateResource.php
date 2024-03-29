<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsStateResource extends JsonResource
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
            'state_name' => $this->state_name,
            'state_initial' => $this->state_initial,
            'default_category' => $this->default_category,
            'remarks' => $this->remarks,
            'status' => $this->status,
            'registration_url'  => $this->registration_url,
            'total_urls' => $this->total_urls
        ];
    }
}
