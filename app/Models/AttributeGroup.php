<?php

namespace App\Models;

use App\Enums\AttributeGroupSelectTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'select_type',
        'filterable',
    ];

    protected $casts = [
        'select_type' => AttributeGroupSelectTypeEnum::class,
        'filterable'  => 'boolean',
    ];
}
