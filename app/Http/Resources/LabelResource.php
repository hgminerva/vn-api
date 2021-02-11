<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
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
            'code' => $this->code,
            'label' => $this->label,
            'displayed_label' => $this->displayed_label
        ];
    }
}
