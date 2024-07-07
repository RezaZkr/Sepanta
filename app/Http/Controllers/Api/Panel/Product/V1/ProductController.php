<?php

namespace App\Http\Controllers\Api\Panel\Product\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Panel\Product\V1\ProductStoreRequest;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function store(ProductStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $product = Product::query()
                ->create([
                    'title'  => $request->input('title'),
                    'weight' => $request->input('weight', 0),
                ]);

            foreach ($request->input('stocks') as $stock) {
                $createdStock = Stock::query()
                    ->create([
                        'product_id' => $product->id,
                        'price'      => $stock['price'],
                        'count'      => $stock['count'],
                    ]);

                $attributes = Attribute::query()
                    ->whereIn('id', $stock['attributes'])->get();
                $arr = [];
                foreach ($attributes as $attribute) {
                    $arr[] = [
                        'attribute_group_id' => $attribute->attribute_group_id,
                        'attribute_id'       => $attribute->id,
                    ];
                }

                $createdStock->attributes()->attach($arr);
            }
            DB::commit();

            return response()->success();

        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return response()->error();
        }

    }
}
