<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorApplicationResource extends JsonResource
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
            'doctor_id' => $this->doctor_id,
            'doctor' => new DoctorResource($this->whenLoaded('doctor')),
            'job_posting_id' => $this->job_posting_id,
            'institutionjobposting' => new InstitutionJobPostingResource($this->whenLoaded('institutionjobposting')),
            'institution_id' => $this->institution_id,
            'institution' => new InstitutionResource($this->whenLoaded('institution')),
            'applied_date' => $this->applied_date,
            'remarks' => $this->remarks,
            'status' => $this->status,
        ];
    }
}
