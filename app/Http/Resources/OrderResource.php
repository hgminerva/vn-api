<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'customer_name' => $this->customer_name,
            'email' => $this->email,
            'customer_address' => $this->customer_address,
            'product_code' => $this->product_code,
            'result' => $this->result,
        ];
    }
}
