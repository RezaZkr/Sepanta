<?php

namespace Database\Seeders;

use App\Enums\AttributeGroupSelectTypeEnum;
use App\Models\Attribute;
use App\Models\AttributeGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $color = AttributeGroup::query()->where('name', '=', 'Color')->first();
        $size = AttributeGroup::query()->where('name', '=', 'Size')->first();
        Attribute::query()->insert([
            [
                'attribute_group_id' => $color->id,
                'name'               => 'Blue',
                'value'              => '#007BA7',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'attribute_group_id' => $color->id,
                'name'               => 'Green',
                'value'              => '#228B22',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],

            [
                'attribute_group_id' => $size->id,
                'name'               => 'Small',
                'value'              => 'S',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'attribute_group_id' => $size->id,
                'name'               => 'Medium',
                'value'              => 'M',
                'created_at'         => now(),
                'updated_at'         => now(),
            ],

        ]);
    }
}
