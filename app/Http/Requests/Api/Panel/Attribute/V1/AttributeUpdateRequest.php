<?php

namespace App\Http\Requests\Api\Panel\Attribute\V1;

use Illuminate\Foundation\Http\FormRequest;

class AttributeUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name'               => ['required', 'string', 'min:1', 'max:255'],
            'value'              => ['nullable', 'string', 'min:1', 'max:255'],
        ];
    }

}
