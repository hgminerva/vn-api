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

            'customer_id' => $this->id,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            
            'name' => $this->id,
            'user_number' => $this->id,
            'email' => $this->id,
            'cellphone' => $this->id,
            'address' => $this->id,
            'zipcodes' => $this->id,
            'distance_willing' => $this->id,
            'keywords' => $this->id,
            'remarks' => $this->id,

            'user_id' => $this->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'us_state_id' => $this->id,
            'us_state' => new UsStateResource($this->whenLoaded('us_state')),
            'us_state_category_id' => $this->id,
            'us_state_category' => new UsStateCategoryResource($this->whenLoaded('us_state_category')),

            'enabled' => $this->id,
        ];
    }
}
