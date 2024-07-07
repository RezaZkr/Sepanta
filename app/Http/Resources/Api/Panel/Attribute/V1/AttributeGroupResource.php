<?php

namespace App\Http\Resources\Api\Panel\Attribute\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeGroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'select_type' => $this->select_type->labelText(),
            'filterable'  => $this->filterable,
            'created_at'  => $this->created_at,
        ];
    }
}
