<?php

namespace App\Models;

use App\Enums\DayType;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class Day extends Model
{
    protected $fillable = [
        'date',
        'type',
    ];

    protected $casts = [
        'type' => DayType::class,
    ];

    public static function date($date): string
    {
        self::validateDate($date);

        $dayOfWeek = date('l', strtotime($date));
        $defaultType = match ($dayOfWeek) {
            'Saturday', 'Sunday' => DayType::NO_CLASS,
            'Monday' => DayType::HOMEROOM,
            default => DayType::WIN,
        };

        $day = Day::firstOrCreate(
            ['date' => $date],
            ['type' => $defaultType]
        );

        return $day->type->label();
    }

    public static function setDate($date, $type): void
    {
        self::validateDate($date);

        $saveType = match ($type) {
            'no_school' => DayType::NO_CLASS,
            'no_class' => DayType::NO_CLASS,
            'homeroom' => DayType::HOMEROOM,
            'win' => DayType::WIN,
            default => throw new InvalidArgumentException('Invalid type provided'),
        };
        Day::upsert(
            ['date' => $date, 'type' => $saveType],
            ['date'],
            ['type']
        );
    }

    private static function validateDate($date): void
    {
        // Check format YYYY-MM-DD using regex
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new InvalidArgumentException('Date must be in YYYY-MM-DD format');
        }

        // Validate if it's a real date
        if (!strtotime($date)) {
            throw new InvalidArgumentException('Invalid date provided');
        }
    }
}
