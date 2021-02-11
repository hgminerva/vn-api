<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorEvaluationResource extends JsonResource
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
            'institution_id' => $this->institution_id,
            'institution' => new InstitutionResource($this->whenLoaded('institution')),
            'evaluation_date' => $this->evaluation_date,
            'evaluation' => $this->evaluation
        ];
    }
}
