<?php

namespace App\Http\Requests\Api\Panel\Product\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title'  => ['required', 'string', 'max:500', 'unique:products,title'],
            'weight' => ['required', 'numeric', 'min:1', 'max:500000'],

            'stocks'                => ['required', 'array'],
            'stocks.*.price'        => ['required', 'numeric', 'min:0', 'max:9999999999'],
            'stocks.*.count'        => ['required', 'numeric', 'min:0'],
            'stocks.*.attributes'   => ['nullable', 'array'],
            'stocks.*.attributes.*' => ['numeric', 'distinct', Rule::exists('attributes', 'id')],
        ];
    }

}
