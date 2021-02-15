<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerUserResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'user_number' => $this->user_number,
    
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'name' => $this->name,
            'date_of_birth' => $this->date_of_birth,
            'age_group' => $this->age_group,
            
            'email' => $this->email,
            'cellphone' => $this->cellphone,
            'address' => $this->address,
            'zipcodes' => $this->zipcodes,
            'home_county' => $this->home_county,
    
            'distance_willing' => $this->distance_willing,
            'keywords' => $this->keywords,
    
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'us_state_id' => $this->us_state_id,
            'us_state' => new UsStateResource($this->whenLoaded('us_state')),
            'us_state_category_id' => $this->us_state_category_id,
            'us_state_category' => new UsStateCategoryResource($this->whenLoaded('us_state_category')),
    
            'enrollment_date' => $this->enrollment_date,
            'enrollment_out_date' => $this->enrollment_out_date,
            
            'employment_number' => $this->employment_number,
            'employment_type' => $this->employment_type,
            'employment_county' => $this->employment_county,
    
            'remarks' => $this->remarks,
            'enabled' => $this->enabled
        ];
    }
}
