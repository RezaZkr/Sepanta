<?php

namespace App\Http\Resources\Api\Panel\Attribute\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'value'      => $this->value,
            'created_at' => $this->created_at,
            'group'      => AttributeGroupResource::make($this->whenLoaded('attributeGroup')),
        ];
    }
}
