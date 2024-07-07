<?php

namespace App\Http\Controllers\Api\Panel\Attribute\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Panel\Attribute\V1\AttributeStoreRequest;
use App\Http\Requests\Api\Panel\Attribute\V1\AttributeUpdateRequest;
use App\Http\Resources\Api\Panel\Attribute\V1\AttributeResource;
use App\Models\Attribute;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AttributeController extends Controller
{
    public function store(AttributeStoreRequest $request): AttributeResource
    {
        $attribute = Attribute::query()
            ->updateOrCreate([
                'attribute_group_id' => $request->input('attribute_group_id'),
                'name'               => $request->input('name'),
            ], [
                'value' => $request->input('value'),
            ]);

        return AttributeResource::make($attribute->load('attributeGroup'));
    }

    public function update(AttributeUpdateRequest $request, Attribute $attribute): AttributeResource|ValidationException
    {
        $cant = Attribute::query()
            ->where('id', '!=', $attribute->id)
            ->where('attribute_group_id', '=', $attribute->attribute_group_id)
            ->where('name', '=', $request->input('name'))
            ->exists();
        if ($cant) {
            throw ValidationException::withMessages(['attribute' => trans('general.duplicate_entry')]);
        }

        $attribute->update([
            'name'  => $request->input('name'),
            'value' => $request->input('value'),
        ]);

        return AttributeResource::make($attribute->load('attributeGroup'));
    }

    public function destroy(Attribute $attribute): JsonResponse
    {
        $cant = DB::table('attribute_stock')
            ->where('attribute_id', '=', $attribute->id)
            ->exists();

        if ($cant){
            return response()->error(message: trans('general.cant_delete'));
        }

        $attribute->delete();
        return response()->success();
    }

    public function show(Attribute $attribute): AttributeResource
    {
        return AttributeResource::make($attribute->load('attributeGroup'));

    }
}
