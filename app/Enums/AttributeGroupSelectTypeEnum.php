<?php

namespace App\Enums;

enum AttributeGroupSelectTypeEnum: int
{
    case RADIO = 1;
    case SELECT = 2;

    public function labelText(): string
    {
        return match ($this) {
            self::RADIO => trans('attribute_group.radio'),
            self::SELECT => trans('attribute_group.select'),
        };
    }
}
