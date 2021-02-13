<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'customer_name' => $this->customer_name,
            'contact_person' => $this->contact_person,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'image_url' => $this->image_url,
            'remarks' => $this->remarks,
            'enabled' => $this->enabled
        ];
    }
}
