<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstitutionResource extends JsonResource
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
            'institutions_number' => $this->institutions_number,
            'image_url' => $this->image_url,
            'institution' => $this->institution,
            'introduction' => $this->introduction,
            'website' => $this->website,
            'enable' => $this->enable,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),

            'postal_code' => $this->postal_code,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'area' => $this->area,
            'remarks' => $this->remarks,
            
            'founder_name' => $this->founder_name,
            'manager_name' => $this->manager_name,
            'facility_type' => $this->facility_type,                
            'medical_department' => $this->medical_department,
    
            'staffs' => $this->staffs,                       
            'number_of_staffs' => $this->number_of_staffs,             
            'hospital_beds' => $this->hospital_beds,                
            'number_of_hospital_beds' => $this->number_of_hospital_beds,      
            'patients_a_day' => $this->patients_a_day,               
            'number_of_patients_a_day' => $this->number_of_patients_a_day,     
            'specialists' => $this->specialists,
            'number_of_specialists' => $this->number_of_specialists,       
            'treatments' => $this->treatments,
            'number_of_treatments' => $this->number_of_treatments
        ];
    }
}
