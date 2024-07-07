<?php

namespace Database\Seeders;

use App\Enums\AttributeGroupSelectTypeEnum;
use App\Models\AttributeGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeGroup::query()->insert([
            [
                'name'        => 'Color',
                'select_type' => AttributeGroupSelectTypeEnum::RADIO->value,
                'filterable'  => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Size',
                'select_type' => AttributeGroupSelectTypeEnum::SELECT->value,
                'filterable'  => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
