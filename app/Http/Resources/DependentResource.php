<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DependentResource extends JsonResource
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

            'customer_user_id' => $this->customer_id,
            'customer_user' => new CustomerUserResource($this->whenLoaded('customer_user')),

            'customer_user_dependent_id' => $this->customer_user_dependent_id,
            'customer_user_dependent' => new CustomerUserResource($this->whenLoaded('customer_user_dependent')),
            
            'relationship' => $this->relationship,
            'remarks' => $this->remarks
        ];
    }
}
