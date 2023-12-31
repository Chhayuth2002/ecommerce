<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductAttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'attribute' => new AttributeResource($this->whenLoaded('attribute')),
            'attribute_option' => new AttributeOptionResource($this->whenLoaded('option')),
        ];
    }
}
