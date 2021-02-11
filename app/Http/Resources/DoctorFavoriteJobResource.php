<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorFavoriteJobResource extends JsonResource
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
            'remarks' => $this->remarks,
        ];
    }
}
