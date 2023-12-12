<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'number' => $this->number,
            'customer_id' => $this->customer_id,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'items' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'country' => $this->country,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'note' => $this->note,
        ];
    }
}
