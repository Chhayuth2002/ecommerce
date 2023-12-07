<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'isVisible' => $this->is_visible,
            'description' => $this->description,
            'order' => $this->order,
            'childrens' => self::collection($this->whenLoaded('children')),
            'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
