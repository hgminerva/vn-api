<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'doctor_number' => $this->doctor_number,
            'image_url' => $this->image_url,
            'name' => $this->name,
            'furigana' => $this->furigana,
            'introduction' => $this->introduction,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'enable' => $this->enable,
            'user_id' => $this->user_id,      
            'user' => new UserResource($this->whenLoaded('user')),            
    
            'place_of_residency' => $this->place_of_residency,
            'postal_code' => $this->postal_code,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            
            'work_history' => $this->work_history,
            'educational_background' => $this->educational_background,
            'medical_department' => $this->medical_department,
            'qualifications' => $this->qualifications,
            'specialist' => $this->specialist,
            'certified_physician' => $this->certified_physician,
            'area_of_expertise' => $this->area_of_expertise,
            'awards' => $this->awards,
            
            'living_with_family' => $this->living_with_family,
            'have_dependents' => $this->have_dependents,
            'remarks' => $this->remarks
        ];
    }
}
