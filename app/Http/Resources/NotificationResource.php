<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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

            'batch_number' => $this->batch_number,
            'batch_date' => $this->batch_date,
            'batch_time' => $this->batch_time,

            'customer_user_id' => $this->customer_user_id,
            'customer_user' => new CustomerUserResource($this->whenLoaded('customer_user')),

            'vaccine_url_id' => $this->vaccine_url_id,
            'vaccine_url' => new VaccineUrlResource($this->whenLoaded('vaccine_url')),

            'is_sms_sent' => $this->is_sms_sent,
            'is_email_sent' => $this->is_email_sent,
            'zipcode_type' => $this->zipcode_type,
            'distance' => $this->distance
        ];
    }
}
