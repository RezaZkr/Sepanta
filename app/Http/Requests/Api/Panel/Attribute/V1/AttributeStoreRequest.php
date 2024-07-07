<?php

namespace App\Http\Requests\Api\Panel\Attribute\V1;

use Illuminate\Foundation\Http\FormRequest;

class AttributeStoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'attribute_group_id' => ['required', 'exists:attribute_groups,id'],
            'name'               => ['required', 'string', 'min:1', 'max:255'],
            'value'              => ['nullable', 'string', 'min:1', 'max:255'],
        ];
    }

}
