<?php

namespace App\Enums;

enum DayType: string
{
    case NO_CLASS = 'no-class';
    case HOMEROOM = 'homeroom';
    case WIN = 'win';

    public function label(): string
    {
        return match ($this) {
            self::NO_CLASS => 'No Class',
            self::HOMEROOM => 'Homeroom',
            self::WIN => 'WIN',
        };
    }
}
